<!doctype html>
<html lang="id">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stunting Kep. Meranti</title>
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
    <link type="image/x-icon" href="/favicon.ico" rel="icon">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
  </head>

  <body class="flex h-screen w-full bg-slate-300 justify-center items-center">
    <div class="w-full md:w-1/3 lg:w-1/4 flex flex-col items-center space-y-4 p-2 md:p-0">
      <img src="{{ asset('images/management.png') }}" class="w-24 h-auto" alt="QR Code Flaticon">

      <div class="mt-6">
        <p class="text-2xl">Login System</p>
      </div>
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="/login" method="POST" method="post" class=" w-full space-y-6">
        @csrf
        <div class="grid space-y-1 p-2 bg-slate-100 rounded">
          <label for="" class="text-gray-600 text-sm font-light">Username</label>
          <input type="text" value="{{ old('email') }}" name="email"
            class="bg-transparent focus:outline-none border-b-2 border-gray-400" autofocus required
            placeholder="Username">
          @error('email')
          <p class="text-sm font-medium">{{ $message }}</p>
          @enderror
        </div>
        <div class="grid space-y-1 px-2 py-3 bg-slate-100 rounded">
          <label for="" class="text-gray-600 text-sm font-light">Kata sandi</label>
          <input type="password" name="password" class="bg-transparent focus:outline-none border-b-2 border-gray-400"
            autofocus required placeholder="Kata sandi">
          @error('password')
          <p class="text-sm font-medium">{{ $message }}</p>
          @enderror
        </div>
        <button
          class="bg-gray-800 rounded flex justify-center space-x-2 text-white font-medium tracking-wider w-full py-3">
          <span>Login</span>
        </button>
      </form>

    </div>

  </body>

</html>