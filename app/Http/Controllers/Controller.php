<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Generate billing link, save data form, create sessionId
     *
     */
    public function getLink(Request $request) {
        $sum = $request->get('sum');
        $text = $request->get('text');
        $sessionId = session_create_id();
        session([$sessionId => implode(',', [$sum, $text])]);

        return view('billing', [
            'sessionLink' => "http://localhost:8000/payments/card/form?sessionId=$sessionId",
            'sessionId' => $sessionId,
            'sum' => $sum,
            'text' => $text
        ]);
    }

    /**
     * Show Payment form with session information
     */
    public function form(Request $request) {
        $id = $request->get('sessionId');
        [$sum, $text] = explode(',', session($id));

        return view('payment', [
            'sessionId' => $id,
            'sum' => $sum,
            'text' => $text,
        ]);
    }

    /**
     * Checking card number and holder name
     */
    public function check(Request $request) {
        $sessionId = $request->get('sessionId');
        [$sum, $text] = explode(',', session($sessionId));
        $number = $request->get('card-number');
        $name = trim($request->get('card-name'));

        if(!preg_match("/[A-Z] [A-Z]/i", $name)) {
            return view('payment', [
                'sessionId' => $sessionId,
                'sum' => $sum,
                'text' => $text,
                'error' => 'Invalid card holder name'
            ]);
        }

        if($number && $this->checkLuna($number)) {
            return view('success');
        } else {
            return view('payment', [
               'sessionId' => $sessionId,
               'sum' => $sum,
               'text' => $text,
               'error' => 'Card is not valid!'
            ]);
        }
    }

    /**
     * Luna Algorithm
     *
     * @param string $cardNumber
     * @return bool
     */
    protected function checkLuna(string $cardNumber): bool {
        // оставить только цифры
        $s = strrev(preg_replace('/[^\d]/','',$cardNumber));

        // вычисление контрольной суммы
        $sum = 0;
        for ($i = 0, $j = strlen($s); $i < $j; $i++) {
            // использовать четные цифры как есть
            if (($i % 2) == 0) {
                $val = $s[$i];
            } else {
                // удвоить нечетные цифры и вычесть 9, если они больше 9
                $val = $s[$i] * 2;
                if ($val > 9)  $val -= 9;
            }
            $sum += $val;
        }

        // число корректно, если сумма равна 10
        return (($sum % 10) == 0);
    }
}
