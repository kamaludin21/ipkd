<div class="p-2 md:px-5 lg:px-28 pt-10 pb-2 space-x-4 w-full overflow-x-auto whitespace-nowrap">
  @foreach ($parentDocument as $item)
  <a href="/dokumen/{{ $item->slug }}" class="p-2 hover:bg-blue-500 ring-2  text-lg font-bold rounded-md {{ (request()->is('dokumen/'.$item->slug.'')) ? 'bg-blue-600 ring-blue-700 shadow-lg text-white' : 'bg-gray-100
    ring-transparent text-gray-800 ' }}"">
    {{ $item->name }}
  </a>
  @endforeach
</div>