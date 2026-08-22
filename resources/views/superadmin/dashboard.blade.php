@extends('layouts.superadmin')

@section('title', 'Dashboard Super Admin')
@section('page_title', 'Dashboard Super Admin')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold">Selamat datang, Super Admin!</h2>
        <p class="text-gray-600 mt-2">Ini adalah dashboard khusus Super Admin.</p>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/superadmin/manajemen-admin.js') }}"></script>
@endpush