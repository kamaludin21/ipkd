@extends('layouts.app')

@section('content')
@include('components.document-nav', $parentDocument)
@unless (count($document))
<tr class="">
  <td class="py-20 w-full" colspan="6">
    <div class="flex flex-col items-center">
      <img src="{{ asset('images/empty.png') }}" class="w-28 h-auto" alt="Kosong">
      <p class="text-lg font-semibold">Data Dokumen Kosong</p>
    </div>
  </td>
</tr>
@endunless
<div class="p-2 md:px-5 lg:px-28 py-10 pb-2 w-full overflow-x-auto whitespace-nowrap">
  <p class="text-3xl py-4 font-semibold">Tahun {{ $parentDocumentData->name ?? ''}}</p>
  <hr class="mb-4">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach ($document as $item)
    <div class="bg-white border p-4 rounded-lg">
      <p class="text-xl font-semibold">{{ $item->name }}</p>
      <p class="text-sm">{{ $item->description }}</p>
      <div class="space-x-2 mt-2">
        <a href="{{ Storage::disk('local')->url($item->file) }}"
          class="text-sm p-1.5 bg-blue-600 hover:bg-blue-500 hover:shadow-md rounded-md text-white" download>
          Unduh Dokumen
        </a>
        <a href="{{ route('dokumen.detail', $item->slug) }}"
          class="text-sm p-1.5 bg-white hover:bg-gray-200 rounded-md hover:shadow-md text-blue-600 ring-2 ring-inset ring-blue-600">
          Preview
        </a>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
