<!doctype html>
<html lang="id">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>IPKD</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="title" content="Stunting Kab. Kepulauan Meranti">
  <meta name="description"
    content="Portal media komunikasi dan informasi dari program penanganan stunting pemerintah Kab. Kepulauan Meranti">
  <meta name="keywords" content="stunting, kepulauan meranti, kesehatan, gizi, balita, vitamin, kesehatan">
  <meta name="robots" content="index, follow">
  <meta name="language" content="English">
  <meta name="revisit-after" content="7 days">
  <meta name="author" content="Diskominfotik Kep. Meranti">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  @vite('resources/css/app.css')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link http-equiv="Content-Security-Policy" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <!-- Google tag (gtag.js) -->
  <script http-equiv="Content-Security-Policy" async src="https://www.googletagmanager.com/gtag/js?id=G-7YGVXFGFLC"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-7YGVXFGFLC');
  </script>
</head>

<body class="font-inter">
  <nav
    class="sticky top-0 z-50 flex py-3 bg-white shadow-lg px-2 md:px-5 lg:px-28 items-center w-full justify-between border-b-4 border-blue-600">
    <a href="/">
      <img src="{{ asset('images/logo_kepmeranti.png') }}" class="w-32 h-auto" alt="Logo pemerintah kep. meranti">
    </a>
    <div class="block md:hidden p-1 border-2 rounded-md group">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" stroke-width="2"
        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M4 6l16 0"></path>
        <path d="M4 12l16 0"></path>
        <path d="M4 18l16 0"></path>
      </svg>
      <div class="hidden text-lg  group-hover:block absolute bg-transparent left-0 w-full">
        <div class="bg-white text-center text-xl space-y-4 px-2 py-4 shadow-md mt-5">
          <div>
            <a href="/"
              class="duration-300 hover:bg-blue-600 hover:text-white rounded-md px-1 {{ request()->is('/') ? 'font-bold text-blue-600' : '' }}">Beranda</a>
          </div>

          <div>
            <a href="/dokumen" class="duration-300 hover:bg-blue-600 hover:text-white rounded-md px-1">Dokumen</a>
          </div>

        </div>
      </div>
    </div>
    <div class="hidden md:flex text-center items-center space-x-4 text-lg">
      <a href="/"
        class="duration-300 hover:bg-blue-600 hover:text-white rounded-md px-1 {{ request()->is('/') ? 'font-bold text-blue-600' : '' }}">Beranda</a>
      <a href="/dokumen"
        class="duration-300 hover:bg-blue-600 hover:text-white rounded-md px-1 {{ request()->is('dokumen*') ? 'font-bold text-blue-600' : '' }}">Dokumen</a>

    </div>
  </nav>
  <div class="pt-10 pb-20">
    @yield('content')
  </div>
  <footer
    class="px-2 md:px-5 lg:px-28 w-full py-10 flex flex-col md:flex-row justify-between bg-white border-t-4 border-blue-600">
    <div class="w-full md:w-1/3 ">
      <img src="{{ asset('images/logo_kepmeranti.png') }}" class="w-44 h-auto" alt="">
      <p class="text-base mt-4">
        Website ini sebagai media komunikasi dari Indeks Pengelolaan Keuangan Daerah
      </p>
      <p class="mt-4">Hak Cipta &#169; 2023</p>
      <p class="font-bold">Diskominfotik Kep. Meranti</p>
    </div>
  </footer>
</body>

</html>