<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>IPKD Adminstrator</title>
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-7YGVXFGFLC"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-7YGVXFGFLC');
  </script>
</head>

<body>
  @include('components.commons.loading')
  <main class="flex h-screen overflow-hidden">
    <nav id="navbar"
      class="fixed h-screen w-4/5 transform border-r-2 bg-white transition-all md:w-1/3 lg:static lg:w-1/4 z-30 overflow-y-auto pb-10 -translate-x-full lg:translate-x-0">
      <div
        class="mb-4 flex flex-row lg:flex-col justify-between items-center lg:justify-center space-x-0 space-y-0 p-4 lg:space-x-2 lg:space-y-2 lg:p-6">
        <img src="{{ asset('images/management.png') }}" alt="Flaticon IMG" class="h-auto w-12" />
        <p
          class="hidden whitespace-nowrap rounded-md text-blue-500/90 px-2 pb-0.5 text-sm lg:text-xl font-black  lg:block">
          IPKD APP
        </p>
        <button onclick="showNavbar()" type="button"
          class="block lg:hidden bg-transparent p-2 border-2 hover:bg-gray-200 rounded-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-600" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M18 6l-12 12"></path>
            <path d="M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      <hr class="my-4 hidden lg:block" />
      <p class="px-6 pb-2 text-sm font-medium text-slate-500">Main Menu</p>
      <ul class="space-y-2 text-slate-700">
        <li class="group flex w-full cursor-pointer items-center pl-4 pr-2">
          <a href="/admin/beranda"
            class="flex w-full space-x-2 rounded-lg py-2 duration-300 hover:bg-blue-400 group-hover:px-4 admin-nav items-center {{ request()->routeIs('beranda') ? 'active-nav' : 'px-2' }}">
            @include('components.icons.home')
            <p class="pt-0.5 font-medium">Beranda</p>
          </a>
        </li>
        <li class="group flex w-full cursor-pointer items-center pl-4 pr-2">
          <a href="{{ route('admin.document.index') }}"
            class="flex w-full space-x-2 rounded-lg py-2 duration-300 hover:bg-blue-300 group-hover:px-4 items-center {{ request()->routeIs('admin.document.*') ? 'active-nav' : 'px-2' }}">
            @include('components.icons.news')
            <p class="pt-0.5 font-medium">Dokumen</p>
          </a>
        </li>
        <li class="group flex w-full cursor-pointer items-center pl-4 pr-2">
          <a href="{{ route('admin.parentdocument.index') }}"
            class="flex w-full space-x-2 rounded-lg py-2 duration-300 hover:bg-blue-300 group-hover:px-4 items-center {{ request()->routeIs('admin.parentdocument.*') ? 'active-nav' : 'px-2' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
              <path d="M16 3v4" />
              <path d="M8 3v4" />
              <path d="M4 11h16" />
              <path d="M11 15h1" />
              <path d="M12 15v3" />
            </svg>
            <p class="pt-0.5 font-medium">Tahun</p>
          </a>
        </li>
      </ul>
    </nav>
    <div onclick="showNavbar()" role="button" id="layer"
      class="absolute w-screen h-screen hidden md:hidden bg-gray-700/50 z-20">
    </div>
    <div class="w-full ">
      <nav class="flex w-full items-center justify-between self-start border-b-2 bg-white py-4 pl-4">
        <button onclick="showNavbar()" type="button" class="block lg:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" width="24" height="24" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M4 6l16 0"></path>
            <path d="M4 12l16 0"></path>
            <path d="M4 18l16 0"></path>
          </svg>
        </button>
        <div class="flex items-end space-x-2">
          <p class="text-3xl font-semibold capitalize">{{ currentRoutePosition() }}</p>
        </div>
        <div class="relative flex cursor-pointer items-center mr-4">
          <div onclick="showUserDropdown()"
            class="z-10 flex h-10 p-0.5 w-10 rounded-xl bg-white ring-1 hover:ring-2 ring-gray-300">
            <img src="{{ asset('images/nutritionist.png') }}" alt="user"
              class="z-0 h-full w-full rounded-xl object-cover" />
          </div>
          <div id="user-dropdown" class="absolute right-0 top-0 pt-12 hidden">
            <div class="w-fit space-y-2 rounded-lg border-2 bg-white py-2 px-4 shadow-md">
              <div class="">
                <p class="text-sm font-medium text-gray-500">{{ Auth::user()->name }}</p>
                <p class="text-xs font-normal text-gray-500">
                  {{ Auth::user()->email }}
                </p>
              </div>
              <hr />
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <ul class="whitespace-nowrap">
                  {{-- <li class="cursor-pointer hover:underline">Pengaturan Akun</li> --}}
                  <li class="cursor-pointer hover:underline">
                    <button role="button" type="submit" class="hover:underline">Logout</button>
                  </li>
                </ul>
              </form>
            </div>
          </div>
        </div>
      </nav>
      <section class="w-full px-4 pt-4 pb-24 bg-gray-200 overflow-y-auto h-screen">
        @yield('content')
      </section>
    </div>
  </main>
  <div class="w-full h-full bg-black/80 top-0 absolute z-50 items-center justify-center hidden px-2" id="modal-layout">
    @yield('modal')
  </div>
  <script>
    window.addEventListener('load', function() {
      var spinner = document.getElementById('loading-spinner');
      spinner.style.display = 'none';
    });

    function showUserDropdown() {
      let sidebar = document.getElementById("user-dropdown")
      if (sidebar.matches('.hidden')) {
        sidebar.classList.replace('hidden', 'block')
      } else {
        sidebar.classList.replace('block', 'hidden')
      }
    }

    function showNavbar() {
      let navbar = document.getElementById('navbar');
      let layer = document.getElementById('layer');
      if (navbar.classList.contains('-translate-x-full')) {
        navbar.classList.replace('-translate-x-full', 'translate-x-0')
        layer.classList.replace('hidden', 'block')
      } else {
        navbar.classList.replace('translate-x-0', '-translate-x-full')
        layer.classList.replace('block', 'hidden')
      }
    }

    function showForm() {
      let wrapper = document.getElementById('container-wrapper');
      let container = document.getElementById('container');
      if (wrapper.matches('.hidden')) {
        wrapper.classList.replace('hidden', 'flex')
        setTimeout(() => {
          container.classList.replace('translate-x-full', 'translate-x-0')
        }, 100);
      } else {
        container.classList.replace('translate-x-0', 'translate-x-full')
        setTimeout(() => {
          wrapper.classList.replace('flex', 'hidden')
        }, 300);
      }
    }
  </script>
</body>

</html>
