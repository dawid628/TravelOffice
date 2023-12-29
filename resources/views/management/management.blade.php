@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 60vh;">
    <div class="text-center">
        <h2>Wybierz akcję:</h2>
        <a href="{{ route('management_users') }}" class="btn btn-primary btn-lg d-block mb-3 p-4">Użytkownicy</a>
        <a href="{{ route('management_countries') }}" class="btn btn-primary btn-lg d-block mb-3 p-4">Kraje</a>
        <a href="{{ route('management_cities') }}" class="btn btn-primary btn-lg d-block p-4">Miasta</a>
    </div>
</div>
@endsection
