@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 60vh;">
    <div class="text-center">
        <h2>Wybierz akcję:</h2>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('management_users') }}" class="btn btn-primary btn-lg d-block mb-3 p-4">Użytkownicy</a>
        @endif
        <a href="{{ route('management_countries') }}" class="btn btn-primary btn-lg d-block mb-3 p-4">Kraje</a>
        <a href="{{ route('management_cities') }}" class="btn btn-primary btn-lg d-block p-4 mb-3 p-4">Miasta</a>
        <a href="{{ route('management_travels') }}" class="btn btn-primary btn-lg d-block p-4">Podróze</a>
    </div>
</div>
@endsection
