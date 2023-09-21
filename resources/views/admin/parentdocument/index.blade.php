@extends('layouts.admin')

@section('content')
<div class="w-full space-y-4">

  @if (session('success'))
  <div class="w-full grid space-y-2">
    @include('components.commons.alert', ['message' => session('success')])
  </div>
  @endif

  @if ($errors->any())
  <div class="w-full p-2 grid space-y-2 bg-red-100 ring-1 ring-red-300 rounded-md">
    <p class="text-lg font-bold">Error:</p>
    <ul>
      @php($i=1)
      @foreach ($errors->all() as $error)
      <li>{{ $i++ }}. {{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <div class="w-full items-center flex flex-col md:flex-row justify-between">
    <div class=" order-2 md:order-1 flex space-x-2 w-full md:w-2/5">
      @if(request()->routeIs('admin.parentdocument.search'))
      <a href="{{ route('admin.parentdocument.index') }}"
        class="bg-gray-100 hover:bg-blue-600 rounded-lg px-2 flex items-center text-gray-600 hover:text-white">
        @include('components.icons.news')
      </a>
      @endif
      <form action="{{ route('admin.parentdocument.search') }}" method="post"
        class="flex w-full space-x-2 bg-white rounded-lg">
        @csrf
        <input type="search" value="{{ $searching ?? '' }}" name="searching" placeholder="Pencarian"
          class="w-full focus:outline-none py-2 pl-2 bg-transparent">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 p-2 rounded-r-lg">
          @include('components.icons.search')
        </button>
      </form>
    </div>
    <button onclick="showForm()" id="show-modal" type="button"
      class="order-1 md:order-2 mb-2 md:mb-0 flex h-full justify-center items-center space-x-2 w-full md:w-fit bg-blue-500 py-2 px-4 rounded-lg text-white hover:bg-blue-600">
      @include('components.icons.plus')
      <span>Tambah Data</span>
    </button>
  </div>
  <div class="w-full overflow-x-auto">
    <table class="min-w-full bg-white shadow-sm rounded-lg whitespace-nowrap md:whitespace-normal space-x-2 mb-4">
      <thead>
        <tr class="border-b text-sm uppercase font-bold">
          <td class="p-4">No.</td>
          <td class="p-4">Nama</td>
          <td class="p-4">Keterangan</td>
          <td class="sticky right-0 z-10" scope="col"></td>
        </tr>
      </thead>
      <tbody>
        @unless (count($documentParent))
        <tr v-if="slides.length === 0" class="">
          <td class="py-20 w-full" colspan="6">
            <div class="flex flex-col items-center">
              <img src="{{ asset('images/empty.png') }}" class="w-28 h-auto" alt="Kosong">
              <p class="text-lg font-semibold">Data Kosong</p>
            </div>
          </td>
        </tr>
        @endunless
        @foreach ($documentParent as $key => $item)
        <tr class="border-b align-top">
          <td class="p-4">{{ $documentParent->firstItem() + $key }}.</td>
          <td class="p-4">{{ $item->name }}</td>
          <td class="p-4">{{ $item->description }}</td>
          <td class="p-4">
            <a href="{{ route('admin.parentdocument.edit', $item->id) }}">
              <button type="button"
                class="hover:text-blue-600 ring-1 ring-gray-300 text-gray-400 p-1 rounded-md w-min hover:bg-gray-200">
                @include('components.icons.pencil')
              </button>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $documentParent->links() }}
  </div>
</div>
<div id="container-wrapper"
  class="hidden w-screen h-screen bg-black/30 backdrop-blur absolute top-0 left-0 z-40 overflow-hidden justify-end">
  <div id="container" class="duration-300 w-full md:w-1/2 lg:w-1/3 h-screen bg-white translate-x-full">
    <div class="flex bg-gray-200 px-4 py-6 justify-between items-center">
      <p class="text-xl font-semibold">Formulir Parent Dokumen</p>
      <button onclick="showForm()" type="button" class="bg-blue-500 px-2 py-2 rounded-lg text-white hover:bg-blue-600">
        @include('components.icons.remove')
      </button>
    </div>
    <form action="{{ route('admin.parentdocument.create') }}" method="post" class="p-4 space-y-2">
      @csrf
      <div class="space-y-1">
        <label for="" class="text-sm font-medium">Nama</label>
        <input name="name" type="text"
          class="w-full px-2 py-2 rounded ring-gray-300 focus:ring-2 focus:ring-blue-400 outline-none ring-1" required>
      </div>
      <div class="space-y-1">
        <label for="" class="text-sm font-medium">Keterangan</label>
        <input name="description" type="text"
          class="w-full px-2 py-2 rounded ring-gray-300 focus:ring-2 focus:ring-blue-400 outline-none ring-1">
      </div>
      <div class="pt-2 flex justify-end">
        <button type="submit" role="button" class="px-3 py-2 bg-blue-600 text-white rounded">Submit</button>
      </div>
    </form>
  </div>
</div>
@endsection