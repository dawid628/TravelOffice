@extends('layouts.app')
@php
    use App\Enums\UserRole;
@endphp

@section('content')
<div class="container">
    <a href="{{ route('management') }}" class="btn btn-primary mb-3">Powrót</a>
    <a href="{{ route('create-country') }}" class="btn btn-primary mb-3">Dodaj</a>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nazwa</th>
                <th>Utworzono</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
                <tr>
                    <td>{{ $country->id }}</td>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->created_at }}</td>
                    <td>
                        <a href="{{ route('edit-country', $country->id) }}" class="btn btn-success">Edytuj</a>
                        <a href="/country/destroy/{{$country->id}}" class="btn btn-success">Usuń</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
