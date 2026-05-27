@extends('layouts.app')

@section('title','Dashboard')
@section('page-title','Dashboard')
@section('page-subtitle','Monitoring, Validasi, dan Konsolidasi Data SKPD')

@section('content')
<div class="space-y-6">
  <p class="text-gray-600 text-sm">Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>

  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
</div>
</div>
@endsection