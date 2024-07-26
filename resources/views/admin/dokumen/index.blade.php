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
      @if(request()->routeIs('admin.document.search'))
      <a href="{{ route('admin.document.index') }}"
        class="bg-gray-100 hover:bg-blue-600 rounded-lg px-2 flex items-center text-gray-600 hover:text-white">
        @include('components.icons.bulb')
      </a>
      @endif
      <form action="{{ route('admin.document.search') }}" method="post" class="flex w-full space-x-2 bg-white rounded-lg">
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
          <td class="p-4">Tahun</td>
          <td class="p-4">Nama</td>
          <td class="p-4">Deskripsi</td>
          <td class="p-4 w-20">File</td>
          <td class="sticky right-0 z-10" scope="col"></td>
        </tr>
      </thead>
      <tbody>
        @unless (count($document))
        <tr v-if="slides.length === 0" class="">
          <td class="py-20 w-full" colspan="6">
            <div class="flex flex-col items-center">
              <img src="{{ asset('images/empty.png') }}" class="w-28 h-auto" alt="Kosong">
              <p class="text-lg font-semibold">Data Kosong</p>
            </div>
          </td>
        </tr>
        @endunless
        @foreach ($document as $key => $item)
        <tr class="border-b align-top">
          <td class="p-4">{{ $document->firstItem() + $key }}.</td>
          <td class="p-4 text-start">
            <p class="font-medium text-lg">{{ $item->parent->name }}</p>
          </td>
          <td class="p-4 text-start {{ duplicate_find($item->slug) ? 'bg-red-100' : 'bg-transparent' }}">
            <p class="font-medium text-lg">{{ $item->name }}</p>
          </td>
          <td class="p-4 text-start">
            <p class="">{{ Str::limit(strip_tags($item->description), 50, '...') }}</p>
          </td>
          <td class="p-4">
            <a href="{{ route('admin.document.download', $item->id) }}"
              class="bg-gray-200 p-1 flex w-min border-1 hover:ring-2 rounded">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                <path d="M7 11l5 5l5 -5"></path>
                <path d="M12 4l0 12"></path>
              </svg>
            </a>
          </td>
          <td class="p-4">
            <a href="{{ route('admin.document.edit', $item->id) }}">
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
    {{ $document->links() }}
  </div>
</div>
<div id="container-wrapper"
  class="hidden w-screen h-screen bg-black/30 backdrop-blur absolute top-0 left-0 z-40 overflow-hidden justify-end">
  <div id="container" class="duration-300 w-full md:w-1/2 lg:w-1/3 h-screen bg-white translate-x-full">
    <div class="flex bg-gray-200 px-4 py-6 justify-between items-center">
      <p class="text-xl font-semibold">Formulir Dokumen</p>
      <button onclick="showForm()" type="button" class="bg-blue-500 px-2 py-2 rounded-lg text-white hover:bg-blue-600">
        @include('components.icons.remove')
      </button>
    </div>
    <form action="{{ route('admin.document.create') }}" method="post" class="p-4 space-y-2"
      enctype="multipart/form-data">
      @csrf
      <div class="space-y-1">
        <label for="" class="text-sm font-medium">Parent Dokumen</label>
        <select name="document_parent_id" id=""
          class="w-full px-2 py-2 rounded ring-gray-300 focus:ring-2 focus:ring-blue-400 outline-none ring-1 capitalize"
          required>
          @foreach ($parentDocument as $item)
          <option value="{{ $item->id }}">{{ $item->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="space-y-1">
        <label for="" class="text-sm font-medium">Nama</label>
        <input name="name" type="text"
          class="w-full px-2 py-2 rounded ring-gray-300 focus:ring-2 focus:ring-blue-400 outline-none ring-1" required>
      </div>
      <div class="space-y-1">
        <label for="" class="text-sm font-medium">Deskripsi</label>
        <input name="description" type="text"
          class="w-full px-2 py-2 rounded ring-gray-300 focus:ring-2 focus:ring-blue-400 outline-none ring-1">
      </div>
      <div class="space-y-1">
        <label for="" class="text-sm font-medium">Tanggal</label>
        <input name="created_at" type="date"
          class="w-full px-2 py-2 rounded ring-gray-300 focus:ring-2 focus:ring-blue-400 outline-none ring-1">
      </div>
      <div class="space-y-1">
        <label for="" class="text-sm font-medium">File <span class="text-red-400 font-medium text-xs">(Type:PDF, Max-Size:
            20MB)</span></label>
        <input name="file" type="file"
          class="w-full px-2 py-2 rounded ring-gray-300 focus:ring-2 focus:ring-blue-400 outline-none ring-1" accept=".pdf" required>
      </div>
      <div class="pt-2 flex justify-end">
        <button type="submit" role="button" class="px-3 py-2 bg-blue-600 text-white rounded">Submit</button>
      </div>
    </form>
  </div>
</div>
@endsection
