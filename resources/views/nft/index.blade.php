@extends('dashboard.layout')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('NFT Minting') }}
        </h2>

        <div class="p-8 bg-white shadow-xl rounded-2xl border border-gray-100 flex flex-col items-center justify-center text-center">
            <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            
            <h3 class="text-3xl font-extrabold text-gray-900 mb-4">NFT Minting Coming Soon</h3>
            <p class="text-lg text-gray-600 max-w-md mx-auto mb-8">
                We are working hard to bring unique digital assets to the Energy Commons ecosystem. Soon you'll be able to mint and trade energy-related NFTs.
            </p>
            
            <div class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Stay Tuned!
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="p-6 bg-gradient-to-br from-blue-50 to-white rounded-xl border border-blue-100">
                <h4 class="font-bold text-blue-900 mb-2">Energy Certificates</h4>
                <p class="text-sm text-blue-800">Verify your green energy contributions with unique blockchain-based certificates.</p>
            </div>
            <div class="p-6 bg-gradient-to-br from-indigo-50 to-white rounded-xl border border-indigo-100">
                <h4 class="font-bold text-indigo-900 mb-2">Impact Badges</h4>
                <p class="text-sm text-indigo-800">Earn special badges for consistent reporting and community stewardship.</p>
            </div>
        </div>
    </div>
@endsection
