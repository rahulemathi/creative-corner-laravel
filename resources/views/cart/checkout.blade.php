<x-layout>
    <x-slot:title>Checkout - Manhitha Gift Shop</x-slot:title>

    <div class="container mx-auto py-8 px-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden p-6 max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold text-pink-600 dark:text-pink-400 mb-4">Complete Payment</h1>
            <p class="mb-6 text-gray-700 dark:text-gray-300">Amount to pay: ₹{{ number_format($displayAmount, 2) }}</p>

            <button id="rzp-button" class="inline-flex items-center px-6 py-3 bg-pink-600 border border-transparent rounded-lg font-semibold text-white uppercase tracking-widest hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
                Pay with Razorpay
            </button>

            <form id="rzp-payment-form" action="{{ route('cart.payment.store') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                <input type="hidden" name="razorpay_signature" id="razorpay_signature">
            </form>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        const options = {
            key: "{{ $key }}",
            amount: "{{ $amount }}",
            currency: "INR",
            name: "{{ $name }}",
            order_id: "{{ $orderId }}",
            prefill: {
                name: "{{ $prefill['name'] }}",
                email: "{{ $prefill['email'] }}"
            },
            theme: { color: "#ec4899" },
            handler: function (response){
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('rzp-payment-form').submit();
            }
        };

        const rzp1 = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function(e){
            e.preventDefault();
            rzp1.open();
        }
    </script>
</x-layout>

