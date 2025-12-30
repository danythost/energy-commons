@extends('dashboard.layout')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buy Power Units') }}
        </h2>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Choose Payment Method</h3>

            <!-- Amount Selection -->
            <div class="mb-6">
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Select Amount (Power Units)</label>
                <input type="number" id="amount" name="amount" min="1" value="1" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <form id="buyForm" method="POST" action="{{ route('buy.store') }}">
                @csrf
                <input type="hidden" name="payment_method" id="paymentMethod">
                <input type="hidden" name="amount" id="formAmount">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Pay with Ada-Cardano (FIRST) -->
                    <div class="border rounded-lg p-6 hover:shadow-md transition-shadow cursor-pointer border-indigo-200" onclick="selectPayment('ada')">
                        <div class="flex flex-col items-center text-center">
                            <div class="p-3 bg-indigo-100 rounded-full mb-4">
                                <!-- Cardano Logo Placeholder or generic crypto icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-lg mb-2">Cardano (ADA)</h4>
                            <p class="text-sm text-gray-600 mb-4">Pay using your Cardano wallet.</p>
                            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 rounded text-white font-medium mb-3" onclick="prepareSubmit('ada')">Connect Wallet</button>
                            <a href="javascript:void(0)" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium underline" onclick="prepareSubmit('ada')">Connect Wallet Link</a>
                        </div>
                    </div>

                    <!-- Pay with Token (SECOND) -->
                    <div class="border rounded-lg p-6 hover:shadow-md transition-shadow cursor-pointer border-green-200" onclick="selectPayment('token')">
                        <div class="flex flex-col items-center text-center">
                            <div class="p-3 bg-green-100 rounded-full mb-4">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-lg mb-2">Pay with Token</h4>
                            <p class="text-sm text-gray-600 mb-4">Use your Energy Tokens.</p>
                             <button type="submit" class="w-full py-2 px-4 bg-green-600 hover:bg-green-700 rounded text-white font-medium" onclick="prepareSubmit('token')">Pay with Token</button>
                        </div>
                    </div>

                    <!-- Bank Transfer (THIRD) -->
                    <div class="border rounded-lg p-6 hover:shadow-md transition-shadow cursor-pointer border-blue-200" onclick="selectPayment('bank')">
                        <div class="flex flex-col items-center text-center">
                            <div class="p-3 bg-blue-100 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-lg mb-2">Bank Transfer</h4>
                            <p class="text-sm text-gray-600 mb-4">Pay via local bank transfer.</p>
                            <div class="space-y-2 w-full">
                                <button type="button" class="w-full py-2 px-4 bg-gray-100 hover:bg-gray-200 rounded text-sm font-medium text-gray-700" onclick="selectBank('opay')">Opay</button>
                                <button type="button" class="w-full py-2 px-4 bg-gray-100 hover:bg-gray-200 rounded text-sm font-medium text-gray-700" onclick="selectBank('moniepoint')">Moniepoint</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function selectPayment(method) {
            document.getElementById('paymentMethod').value = method;
        }

        function selectBank(bank) {
            document.getElementById('paymentMethod').value = 'bank_' + bank;
            prepareSubmit('bank_' + bank);
        }

        function prepareSubmit(method) {
            document.getElementById('paymentMethod').value = method;
            document.getElementById('formAmount').value = document.getElementById('amount').value;
            
            if (method === 'ada') {
                connectYoroi();
            } else {
                document.getElementById('buyForm').submit();
            }
        }

        async function connectYoroi() {
            if (typeof window.cardano === 'undefined' || typeof window.cardano.yoroi === 'undefined') {
                alert('Yoroi wallet not found. Please install the Yoroi extension.');
                return;
            }

            try {
                // CIP-30 connect
                const api = await window.cardano.yoroi.enable();
                if (api) {
                    alert('Yoroi wallet connected successfully!');
                    // In a real app, you might want to fetch the address or network id here
                    // const address = await api.getUsedAddresses();
                    
                    // Proceed with form submission or next step
                    document.getElementById('buyForm').submit();
                }
            } catch (err) {
                console.error('Connection failed', err);
                alert('Failed to connect to Yoroi wallet: ' + (err.info || err.message || 'Unknown error'));
            }
        }
    </script>
@endsection
