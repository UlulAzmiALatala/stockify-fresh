<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan link untuk mengatur ulang password Anda.') }}
        </div>
    </div>

    <!-- Session Status (Berhasil) -->
    @if (session('status'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 border border-green-300">
            {{ session('status') }}
        </div>
    @endif

    <!-- Error Message (Gagal) -->
    @if ($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 border border-red-300">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
