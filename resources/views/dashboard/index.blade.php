@extends('dashboard.layout')

@section('content')

@if (session('status'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('status') }}
    </div>
@endif
@if ($errors->has('report'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ $errors->first('report') }}
    </div>
@endif

<div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 mb-6">
    <h2 class="font-semibold text-lg text-gray-800">Welcome, {{ Auth::user()->name }}</h2>
    <p class="text-gray-500 text-sm">Dashboard Overview</p>
</div>

<div class="space-y-4">

    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold text-lg">Power Status</h2>
        @if ($powerStatus === 'on')
        <p class="text-green-600 mt-2">Power is ON</p>
        @elseif ($powerStatus === 'off')
            <p class="text-red-600 mt-2">Power is OFF</p>
        @else
            <p class="text-gray-600 mt-2">Power status unknown</p>
        @endif

    </div>

     <div class="grid grid-cols-3 gap-2">

        <!-- Report ON -->
        <form method="POST" action="{{ route('energy.report') }}">
            @csrf
            <input type="hidden" name="type" value="on">
            <button class="w-full bg-green-500 text-white py-3 rounded-lg">
                ON
            </button>
        </form>

        <!-- Report OFF -->
        <form method="POST" action="{{ route('energy.report') }}">
            @csrf
            <input type="hidden" name="type" value="off">
            <button class="w-full bg-red-500 text-white py-3 rounded-lg">
                OFF
            </button>
        </form>

        <!-- Report PROBLEM -->
        <button
            x-data
            @click="$dispatch('open-problem')"
            class="w-full bg-yellow-500 text-white py-3 rounded-lg">
            Problem
        </button>

    </div>

<div
    x-data="{ open: false, imagePreview: null }"
    @open-problem.window="open = true"
>

    <div
        x-show="open"
        x-cloak
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        x-transition
    >
        <div class="bg-white p-6 rounded-lg w-11/12 max-w-md max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-semibold mb-3">
                Report a problem
            </h3>

            <form method="POST" action="{{ route('energy.report') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="problem">

                <!-- Image Upload Section -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        📷 Attach Image (Optional)
                    </label>
                    
                    <input
                        type="file"
                        name="image"
                        id="problemImage"
                        accept="image/*"
                        capture="environment"
                        class="hidden"
                        x-ref="fileInput"
                        @change="
                            const file = $event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = (e) => imagePreview = e.target.result;
                                reader.readAsDataURL(file);
                            }
                        "
                    >
                    
                    <button
                        type="button"
                        @click="$refs.fileInput.click()"
                        class="w-full bg-blue-50 border-2 border-dashed border-blue-300 rounded-lg p-4 text-blue-600 hover:bg-blue-100 transition"
                    >
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-sm">Tap to capture or upload image</span>
                    </button>

                    <!-- Image Preview -->
                    <div x-show="imagePreview" class="mt-3 relative">
                        <img :src="imagePreview" class="w-full rounded-lg border border-gray-300">
                        <button
                            type="button"
                            @click="imagePreview = null; document.getElementById('problemImage').value = ''"
                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Description Textarea -->
                <textarea
                    name="description"
                    required
                    placeholder="Describe the issue..."
                    class="w-full border rounded p-3 mb-4 min-h-[100px]"
                ></textarea>

                <div class="flex gap-2">
                    <button
                        type="submit"
                        class="flex-1 bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600 transition"
                    >
                        Submit
                    </button>

                    <button
                        type="button"
                        @click="open = false; imagePreview = null"
                        class="flex-1 bg-gray-300 py-2 rounded hover:bg-gray-400 transition"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold">My Tokens</h2>
        <p class="text-sm text-gray-600">Power Access: 0</p>
        <p class="text-sm text-gray-600">Steward: 0</p>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold text-lg mb-3">Recent Activity</h2>
        <div class="space-y-3">
            @forelse($events as $event)
                <div class="border-b pb-3 last:border-0 last:pb-0">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="font-medium">
                                @if($event->type === 'on')
                                    <span class="text-green-600">ON</span>
                                @elseif($event->type === 'off')
                                    <span class="text-red-600">OFF</span>
                                @else
                                    <span class="text-yellow-600">Problem</span>
                                @endif
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $event->created_at->diffForHumans() }}
                            </div>
                            @if($event->description)
                                <div class="text-sm text-gray-700 mt-1">
                                    {{ $event->description }}
                                </div>
                            @endif
                            
                            <!-- File Attachments -->
                            @if($event->image_path || $event->text_file_path)
                                <div class="mt-2 flex gap-2 items-center flex-wrap">
                                    @if($event->image_path)
                                        <a href="{{ asset('storage/' . $event->image_path) }}" target="_blank" class="block">
                                            <img 
                                                src="{{ asset('storage/' . $event->image_path) }}" 
                                                alt="Problem image" 
                                                class="w-20 h-20 object-cover rounded border border-gray-300 hover:opacity-80 transition"
                                            >
                                        </a>
                                    @endif
                                    
                                    @if($event->text_file_path)
                                        <a 
                                            href="{{ asset('storage/' . $event->text_file_path) }}" 
                                            download
                                            class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-700 rounded text-xs hover:bg-gray-200 transition"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Download Report
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-sm">No recent activity.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection
