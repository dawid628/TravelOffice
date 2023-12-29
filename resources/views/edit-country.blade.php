@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('management') }}" class="btn btn-primary mb-3">Powrót</a>
            <div class="card myform">
                <div class="card-header">Edycja kraju</div>

                <div class="card-body">
                    <form class="p-3" method="POST" action="{{ route('update-country', $country->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name">Nazwa:</label>
                            <input class="form-control" name="name" id="name" placeholder="Wpisz kraj" value="{{ $country->name }}">
                        </div>
                        <button class="btn btn-primary" type="submit">Zapisz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
