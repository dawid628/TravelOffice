@extends('layouts.app')
@php
    use App\Enums\UserRole;
@endphp

@section('content')
<div class="container">
    <a href="{{ route('management') }}" class="btn btn-primary mb-3">Powrót</a>
    <a href="{{ route('create-city') }}" class="btn btn-primary mb-3">Dodaj</a>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nazwa</th>
                <th>Kraj</th>
                <th>Utworzono</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cities as $city)
                <tr>
                    <td>{{ $city->id }}</td>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->country->name }}</td>
                    <td>{{ $city->created_at }}</td>
                    <td>
                        <a href="{{ route('edit-city', ['id' => $city->id]) }}" class="btn btn-success">Edytuj</a>
                        <a href="/city/destroy/{{$city->id}}" class="btn btn-success">Usuń</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
