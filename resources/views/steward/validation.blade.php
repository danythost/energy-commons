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

@forelse ($events as $event)
    <div class="bg-white p-4 rounded shadow mb-3">
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

                    <button class="bg-green-500 text-white px-3 py-1 rounded">
                        Confirm
                    </button>
                </form>

                <form method="POST" action="{{ route('energy.validate') }}">
                    @csrf
                    <input type="hidden" name="energy_event_id" value="{{ $event->id }}">
                    <input type="hidden" name="decision" value="rejected">

                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                        Reject
                    </button>
                </form>
            </div>
        </div>
    </div>
@empty
    <p class="text-gray-600">
        No events awaiting validation.
    </p>
@endforelse

@endsection
