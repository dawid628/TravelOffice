@extends('layouts.app')
@php
    use App\Models\Travel;
@endphp
@section('content')
<div class="container">
    <h1>Twoje rezerwacje</h1>
    
    @if($reservations->isEmpty())
        <p>Nie zarezerwowałeś jeszcze zadnej podrózy.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Identyfikator podrózy</th>
                    <th>Miejsca</th>
                    <th>Do zapłaty</th>
                    <th>Zapłacono</th>
                    <th>Zarezerwowano</th>
                    <th>Dzień wyjazdu</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->travel_id }}</td>
                        <td>{{ $reservation->headcount }}</td>
                        <td>{{ $reservation->total }}</td>
                        <td>{{ $reservation->paid ? 'Tak' : 'Nie' }}</td>
                        <td>{{ $reservation->created_at->format('Y-m-d') }}</td>
                        <td>{{ Travel::find($reservation->travel_id)->date_from }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('pay', $reservation->id) }}">Zapłać</a>
                            @if($reservation->paid == 0)
                            <a class="btn btn-primary" href="{{ route('reservations.delete', $reservation->id) }}">Anuluj</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection