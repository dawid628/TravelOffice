@extends('layouts.app')
@php
    use App\Enums\UserRole;
@endphp

@section('content')
<div class="container">
    <a href="{{ route('management') }}" class="btn btn-primary mb-3">Powrót</a>
    <a href="{{ route('create-travel') }}" class="btn btn-primary mb-3">Dodaj</a>
    <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nazwa</th>
                <th>Opis</th>
                <th>Początek</th>
                <th>Koniec</th>
                <th>Miejsca</th>
                <th>Cena</th>
                <th>Last minute</th>
                <th>All inclusive</th>
                <th>Obraz</th>
                <th>Utworzono</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($travels as $travel)
                <tr>
                    <td>{{ $travel->id }}</td>
                    <td>{{ $travel->name }}</td>
                    <td>
                        {{ wordwrap($travel->description, 50, "\n", true) }}
                    </td>
                    <td>{{ $travel->date_from }}</td>
                    <td>{{ $travel->date_to }}</td>
                    <td>{{ $travel->places }}</td>
                    <td>{{ $travel->price }}</td>
                    <td>{{ $travel->last_minute }}</td>
                    <td>{{ $travel->all_inclusive }}</td>
                    <td>{{ $travel->photo_path }}</td>
                    <td>{{ $travel->created_at }}</td>
                    <td>
                        <a href="{{ route('edit-travel', $travel->id) }}" class="btn btn-success m-1">Edytuj</a>
                        <a href="/travel/destroy/{{$travel->id}}" class="btn btn-success m-1">Usuń</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
