<x-layout>
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

        <div class="text-gray-600">
            <h1 class="text-center">Billing</h1>
            <form action="/register" class="form-control flex-column p-3" method="post">
                <div>
                    <h5 class="text-primary">Amount ($):</h5>
                    <input type="number" class="form-control" name="sum" placeholder="Enter sum" value="{{ $sum ?? '' }}">
                </div>
                <div class="mt-3">
                    <h5 class="text-primary">Purpose:</h5>
                    <input type="text" class="form-control" name="text" placeholder="Enter goal" value="{{ $text ?? '' }}">
                </div>
                <button class="btn btn-primary mt-3">Get link</button>
            </form>
            @if($sessionLink)
                <div class="mt-3 p-1 text-center">
                    <h5>Here's your link:</h5>
                    <h4 class="text-uppercase"><a href="{{ $sessionLink }}" class="form-check-label">payment link</a></h4>
                </div>
            @endif
        </div>


    </div>
</div>
</x-layout>

