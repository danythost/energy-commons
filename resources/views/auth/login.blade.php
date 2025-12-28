<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800 tracking-tight">
            Energy Commons
        </h1>
        <p class="text-sm text-gray-600 mt-2">
            Track power. Access energy.<br>Support your community.
        </p>
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="sr-only">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                placeholder="Email address"
                required
                autofocus
                class="w-full border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-green-500 shadow-sm"
            />
        </div>

        <div>
           <label for="password" class="sr-only">Password</label>
           <input
                id="password"
                type="password"
                name="password"
                placeholder="Password"
                required
                class="w-full border-gray-300 rounded-lg p-3 focus:border-green-500 focus:ring-green-500 shadow-sm"
            />
        </div>

        <button
            type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-lg transition duration-150 transform hover:scale-[1.02]">
            Sign In
        </button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-xs text-gray-500">
            Wallet & phone login coming soon.
        </p>
    </div>
</x-guest-layout>
