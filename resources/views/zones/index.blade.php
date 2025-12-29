@extends('dashboard.layout')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Community Zones') }}
        </h2>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Available Zones and Their Leaders</h3>

            <div class="space-y-6">
                @foreach($zones as $zone)
                    <div class="border rounded-lg p-6 hover:shadow-md transition-shadow">
                        <h4 class="font-bold text-lg mb-4 text-blue-600">{{ $zone->name }}</h4>

                        @if($zone->leader_name)
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span class="font-medium">{{ $zone->leader_name }}</span>
                                    <span class="text-sm text-gray-500 ml-2">(Leader/Steward)</span>
                                </div>

                                @if($zone->leader_email)
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <a href="mailto:{{ $zone->leader_email }}" class="text-blue-600 hover:text-blue-800">{{ $zone->leader_email }}</a>
                                    </div>
                                @endif

                                @if($zone->leader_phone)
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <a href="tel:{{ $zone->leader_phone }}" class="text-blue-600 hover:text-blue-800">{{ $zone->leader_phone }}</a>
                                    </div>
                                @endif

                                @if($zone->leader_home_address)
                                    <div class="flex items-start">
                                        <svg class="h-5 w-5 text-gray-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="text-gray-700">{{ $zone->leader_home_address }}</span>
                                    </div>
                                @endif

                                @if($zone->leader_ada_wallet)
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        <span class="text-sm text-gray-600 font-mono">{{ $zone->leader_ada_wallet }}</span>
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="text-gray-500 italic">No leader information available</p>
                        @endif
                    </div>
                @endforeach
            </div>

            @if($zones->isEmpty())
                <p class="text-gray-500 text-center py-8">No zones available at the moment.</p>
            @endif
        </div>
    </div>
@endsection
<parameter name="filePath">/opt/lampp/htdocs/energy-commons/resources/views/zones/index.blade.php