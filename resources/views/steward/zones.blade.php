@extends('steward.layout')

@section('steward-content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Zones</h1>
    <p class="text-gray-600">Zone information</p>
</div>

<div class="bg-white p-6 rounded shadow">
    @if($zone)
        <h2 class="text-xl font-semibold mb-4">{{ $zone->name }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 font-medium">Zone ID</p>
                <p class="text-gray-800">{{ $zone->id }}</p>
            </div>
             <!-- Add more zone details here if available -->
        </div>
    @else
        <p class="text-red-600">Zone information not available.</p>
    @endif
</div>
@endsection
