@extends('layouts.app')
@php
    use App\Enums\UserRole;
@endphp

@section('content')
<div class="container">
    <a href="{{ route('management') }}" class="btn btn-primary mb-3">Powrót</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nazwa</th>
                <th>Email</th>
                <th>Rola</th>
                <th>Utworzono</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <form action="{{ route('change-role', ['userId' => $user->id]) }}" method="POST">
                            @csrf
                            <div class="btn-group">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Rola
                                </button>
                                <div class="dropdown-menu">
                                    <button type="submit" class="dropdown-item" name="role" value="{{ UserRole::ADMIN }}"> {{ UserRole::ADMIN }}</button>
                                    <button type="submit" class="dropdown-item" name="role" value="{{ UserRole::MODERATOR }}"> {{ UserRole::MODERATOR }}</button>
                                    <button type="submit" class="dropdown-item" name="role" value="{{ UserRole::USER }}"> {{ UserRole::USER }}</button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
