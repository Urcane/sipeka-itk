@extends('layouts.app')

@section('tittle', 'Data Kartu Keluarga - Sipeka')

@section('nav')
    @include('layouts.nav-layout')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Data Kartu Keluarga</h3>
        <div id="livewire-death-data" class="bg-white p-10 rounded-lg mt-6">
            <livewire:family-card-table />
        </div>
    </div>
</main>
@endsection