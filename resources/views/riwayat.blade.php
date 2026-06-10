@extends('layouts.app')

@section('title', 'Riwayat Laporan - Lapor.in')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#D32F0F] mb-2">Riwayat Laporan Saya</h1>
        <p class="text-gray-500">Pantau status dan progres laporan yang telah Anda kirimkan.</p>
    </div>

    <div class="space-y-4" id="riwayat-container">
        <div class="flex justify-center py-10">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#D32F0F]"></div>
        </div>
    </div>

</div>

@vite('resources/js/riwayat.js')
@endsection