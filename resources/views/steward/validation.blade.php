@extends('steward.layout')

@section('steward-content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-xl font-semibold text-gray-800">
        Validation Requests
    </h1>
    <div class="flex gap-2">
        <a href="{{ route('steward.validation', ['type' => 'problem']) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded shadow transition duration-150">
            Issues
        </a>

    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

@forelse ($events as $event)
    <div class="bg-white p-4 rounded shadow mb-3" x-data="{ showGiftForm: false }">
        <div class="flex justify-between">
            <div>
                <p class="font-medium">
                    {{ strtoupper($event->type) }}
                    <span class="text-sm font-normal text-gray-500 ml-2">
                        by {{ $event->user->name }} ({{ ucfirst($event->user->role) }}) in {{ $event->zone->name }}
                    </span>
                </p>

                <p class="text-sm text-gray-600">
                    {{ $event->created_at->diffForHumans() }}
                </p>

                @if ($event->description)
                    <p class="text-sm mt-2 text-gray-700">
                        {{ $event->description }}
                    </p>
                @endif
            </div>

            <div class="flex gap-2">
                <form method="POST" action="{{ route('energy.validate') }}">
                    @csrf
                    <input type="hidden" name="energy_event_id" value="{{ $event->id }}">
                    <input type="hidden" name="decision" value="confirmed">

                    <button title="Confirm" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </form>

                <form method="POST" action="{{ route('energy.validate') }}">
                    @csrf
                    <input type="hidden" name="energy_event_id" value="{{ $event->id }}">
                    <input type="hidden" name="decision" value="rejected">

                    <button title="Reject" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </form>

                <button title="Gift Token" @click="showGiftForm = !showGiftForm" class="bg-purple-500 hover:bg-purple-600 text-white p-2 rounded transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Gift Token Form (Collapsible) -->
        <div x-show="showGiftForm" x-transition class="mt-4 pt-4 border-t border-gray-200">
            <form method="POST" action="{{ route('steward.gift-token') }}" class="flex items-end gap-3">
                @csrf
                <input type="hidden" name="user_id" value="{{ $event->user->id }}">

                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Token Type</label>
                    <select name="token_type" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        <option value="est">EST (Energy Steward Token)</option>
                        <option value="pat">PAT (Power Access Token)</option>
                    </select>
                </div>

                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                    <input type="number" name="amount" min="1" max="1000" value="10" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500">
                </div>

                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md font-medium">
                    Gift Tokens
                </button>

                <button type="button" @click="showGiftForm = false" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md font-medium">
                    Cancel
                </button>
            </form>
        </div>
    </div>
@empty
    <p class="text-gray-600">
        No events awaiting validation.
    </p>
@endforelse

@endsection
