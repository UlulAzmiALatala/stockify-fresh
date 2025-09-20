<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Stockify</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">

  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img
        src="{{ asset('images/stockify.png') }}"
        alt="Stockify"
        class="mx-auto h-32 w-auto" 
      />
      <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
        Login ke akun Anda
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
          <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">
            Email Anda
          </label>
          <div class="mt-2">
            <input
              id="email"
              name="email"
              type="email"
              value="{{ old('email') }}"
              required
              autofocus
              autocomplete="email"
              placeholder="nama@email.com"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm"
            />
          </div>
          @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white">
              Password
            </label>
            @if (Route::has('password.request'))
              <div class="text-sm">
                <a href="{{ route('password.request') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
                  Lupa password?
                </a>
              </div>
            @endif
          </div>
          <div class="mt-2">
            <input
              id="password"
              name="password"
              type="password"
              required
              autocomplete="current-password"
              placeholder="••••••••"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm"
            />
          </div>
          @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div class="flex items-center">
          <input
            id="remember"
            name="remember"
            type="checkbox"
            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
          />
          <label for="remember" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
            Ingat saya
          </label>
        </div>

        <div>
          <button
            type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >
            Login
          </button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm text-gray-500">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
          Buat akun
        </a>
      </p>
    </div>
  </div>

</body>
</html>