@extends('layouts.app')

@section('content')
@include('components.document-nav', $parentDocument)
<div class="p-2 md:px-5 lg:px-28 pt-10 pb-2 w-full overflow-x-auto whitespace-nowrap">

  <p class="text-3xl font-semibold">{{ $parentDocumentData->name }}</p>
  <hr class="mb-4">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach ($document as $item)
    <div class="bg-white border p-4 rounded-lg">
      <p class="text-xl font-semibold">{{ $item->name }}</p>
      <p class="text-sm">{{ $item->description }}</p>
      <div class="space-x-2 mt-2">
        <a href="" class="text-sm p-1.5 bg-blue-600 hover:bg-blue-500 hover:shadow-md rounded-md text-white" download>
          Unduh Dokumen
        </a>
        <a href="{{ Storage::disk('local')->url('public/docs/inovasi/'.$item->file)}}"
          class="text-sm p-1.5 bg-white hover:bg-gray-200 rounded-md hover:shadow-md text-blue-600 ring-2 ring-inset ring-blue-600"
          target="_blank">
          Preview
        </a>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection