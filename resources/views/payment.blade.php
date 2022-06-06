<x-layout>
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="text-gray-200">
                <h1 class="text-center">Current payment</h1>
                <h6 class="text-center fst-italic text-gray-600">id: {{ $sessionId ?? 'unknown' }}</h6>
                <h3 class="mt-5">Now you will pay <label class="text-primary">{{ $sum ?? '-' }}$</label>
                    for <label class="text-info">"{{ $text ?? '-' }}"</label></h3>
                <h3>Enter your card data below:</h3>
                <form class="form-control flex-column p-4" method="post">
                    @csrf
                    <input type="text" class="form-control" name="card-number" placeholder="card number">
                    <input type="text" class="form-control my-3" name="card-name" placeholder="card holder name">
                    <button class="btn btn-primary" type="submit">Pay now</button>
                    <label class="text-danger">{{ $error ?? '' }}</label>
                </form>
            </div>
        </div>
    </div>
</x-layout>


