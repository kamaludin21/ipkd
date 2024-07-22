@extends('layouts.app')

@section('content')
@include('components.document-nav', $parentDocument)
<div class="p-2 md:px-5 lg:px-28 pt-10 pb-2 w-full overflow-x-auto whitespace-nowrap">

  <p class="text-3xl font-semibold">Informasi Dokumen</p>
  <hr class="mb-4">
  <div class="flex space-x-4">
    <div class="bg-white border p-4 rounded-lg w-full md:w-1/3 space-y-2">
      <div class="w-full ">
        <p class="text-base font-light ">Judul</p>
        <p class="text-lg font-medium whitespace-break-spaces">{{ $document->name ?? '-'}}</p>
      </div>
      <div>
        <p class="text-base font-light">Deskripsi</p>
        <p class="text-lg font-medium whitespace-break-spaces">{{ $document->description ?? '-'}}</p>
      </div>
      <div>
        <p class="text-base font-light">Tahun</p>
        <p class="text-lg font-medium whitespace-break-spaces">{{ $document->parent->name ?? '-'}}</p>
      </div>

      <div>
        <p class="text-base font-light">Dibuat pada</p>
        <p class="text-lg font-medium">{{ \Illuminate\Support\Carbon::parse($document->created_at)->isoFormat("D MMMM Y") }}</p>
      </div>
    </div>
    <div class="bg-white border p-4 rounded-lg flex-1 space-y-4">
      <p class="text-base font-bold">Preview Dokumen</p>
      <hr>
      <embed class="w-full h-[32rem]" src="{{ Storage::disk('local')->url($document->file) }}" type="">
    </div>
  </div>
</div>
@endsection
