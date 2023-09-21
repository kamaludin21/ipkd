@extends('layouts.admin')

@section('content')
<div class="w-full space-y-8">
  <div class="w-full flex items-center space-x-4">
    <div class="w-20 h-20 rounded-full bg-blue-400 px-2 pt-5 overflow-hidden">
      <img src="{{ asset('images/nutritionist.png') }}" class="" alt="">
    </div>
    <div>
      <p class="text-2xl font-bold">Welcome Back, Admin</p>
      <p class="text-lg">Happy to see you again on your dashboard</p>
    </div>
  </div>
</div>
@endsection