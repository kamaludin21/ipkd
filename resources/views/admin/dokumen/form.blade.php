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
  <div class="w-full overflow-x-auto bg-white rounded-lg p-2 md:p-6">
    <div class="flex items-center border-b pb-2 justify-between">
      <div class="flex space-x-2 items-center">
        <a href="{{ route('admin.document.index') }}"
          class="bg-gray-100 hover:bg-blue-600 rounded p-0.5 text-gray-600 hover:text-white">
          @include('components.icons.chevron-left')
        </a>
        <p class="text-2xl font-medium text-gray-600">Edit Dokumen</p>
      </div>
      <button type="button" id="getDialog"
        class="bg-gray-200 hover:shadow-lg ring-1 ring-gray-200 hover:ring-red-600 duration-300 rounded px-4 py-1 text-red-400 hover:text-red-600 font-medium">Hapus</button>
    </div>
    <div class="w-full">
      <form action="{{ route('admin.document.update', $document->id) }}" method="post" class="space-y-2"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="space-y-1">
          <label for="" class="text-sm font-medium">Tahun Dokumen</label>
          <select name="document_parent_id" id=""
            class="w-full px-2 py-2 rounded ring-gray-300 focus:ring-2 focus:ring-blue-400 outline-none ring-1 capitalize"
            required>
            @foreach ($parentDocument as $item)
            <option value="{{ $item->id }}" {{ ($document->document_parent_id === $item->id) ? 'selected' :
              '' }}>{{ $item->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="space-y-1">
          <label for="" class="text-sm font-medium">Nama</label>
          <input name="name" type="text" value="{{ $document->name }}"
            class="w-full px-2 py-2 rounded ring-gray-300 focus:ring-2 focus:ring-blue-400 outline-none ring-1"
            required>
        </div>
        <div class="space-y-1">
          <label for="" class="text-sm font-medium">Deskripsi</label>
          <input name="description" type="text" value="{{ $document->description }}"
            class="w-full px-2 py-2 rounded ring-gray-300 focus:ring-2 focus:ring-blue-400 outline-none ring-1">
        </div>
        <div class="space-y-1">
          {{--  value="{{ $document->created_at }}" --}}
          <label for="" class="text-sm font-medium">Tanggal</label>
          <input name="created_at" type="date" value="{{ \Illuminate\Support\Carbon::parse($document->created_at)->format("Y-m-d") }}"
            class="w-full px-2 py-2 rounded ring-gray-300 focus:ring-2 focus:ring-blue-400 outline-none ring-1">
        </div>
        <div class="space-y-1">
          <label for="" class="text-sm font-medium">File <span class="text-red-400 font-medium text-xs">(Type:PDF, Max-Size:
              20MB)</span></label>
          <input name="file" type="file" value="{{ $document->file }}"
            class="w-full px-2 py-2 rounded ring-gray-300 focus:ring-2 focus:ring-blue-400 outline-none ring-1" accept=".pdf">
        </div>
        <div class="pt-2 flex justify-end">
          <button type="submit" role="button" class="px-3 py-2 bg-blue-600 text-white rounded">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('modal')
<div class="w-full md:w-1/3 lg:w-1/4 h-auto bg-white rounded-lg p-6">
  <p class="text-xl font-medium mb-2">Hapus Data Ini?</p>
  <p>Aksi ini tidak dapat dibatalkan. Lakukan dengan hati-hati!</p>
  <form action="{{ route('admin.document.destroy', $document->id) }}" method="post"
    class="flex justify-end w-full border-t-2 pt-4 mt-2">
    @csrf
    @method('DELETE')
    <button type="submit" class="w-full rounded-md bg-red-600 text-white py-2 hover:bg-red-700 mr-2">Lanjutkan</button>
    <button type="button" id="hide-dialog"
      class="w-full border-2 rounded-md duration-300 bg-gray-200 border-transparent hover:border-gray-600 text-gray-600 hover:text-gray-900">Batal</button>
  </form>
</div>
@endsection
