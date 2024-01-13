@extends('layouts.app')

@section('content')
@php
    use App\Models\Country;
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('management') }}" class="btn btn-primary mb-3">Powrót</a>
            <div class="card myform">
                <div class="card-header">Edycja podrózy</div>

                <div class="card-body">
                    <form class="p-3" method="POST" action="{{ route('update-travel', $travel->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nazwa: </label>
                            <input class="form-control" name="name" value="{{ $travel->name }}"/>
                        </div>
                        <div class="form-group">
                            <label>Opis:</label>
                            <textarea class="form-control" name="description">{{ $travel->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Miasto:</label>
                            <select name="city_id" class="form-control">
                                <option selected value="{{ $travel->city->id }}">{{ Country::find($travel->city->country_id)->name . ' - ' . $travel->city->name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Obraz:</label>
                            <input type="file" class="form-control" name="file"></input>
                        </div>
                        @if($travel->photo_path)
                            <div>
                                <label>Obecny plik:</label>
                                <img src="{{ asset('storage/uploads/' . basename($travel->photo_path)) }}" alt="Obrazek" style="max-width: 100px; max-height: 100px;">
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Dzień wyjazdu:</label>
                            <input type="date" class="form-control" name="date_from" value="{{ $travel->date_from }}"/>
                        </div>
                        <div class="form-group">
                            <label>Dzień powrotu:</label>
                            <input type="date" class="form-control" name="date_to" value="{{ $travel->date_to }}"/>
                        </div>
                        <div class="form-group">
                            <label>Ilość miejsc:</label>
                            <input type="number" class="form-control" name="places" value="{{ $travel->places }}"/>
                        </div>
                        <div class="form-group">
                            <label>Cena za osobę:</label>
                            <input type="number" class="form-control" name="price" value="{{ $travel->price }}"/>
                        </div>
                        <div class="form-group">
                            <label>All inclusive:</label>
                            <select class="form-control" name="all_inclusive">
                                <option value="0" {{ $travel->all_inclusive == 0 ? 'selected' : '' }}>nie</option>
                                <option value="1" {{ $travel->all_inclusive == 1 ? 'selected' : '' }}>tak</option>
                            </select> 
                        </div>
                        <div class="form-group">
                            <label>Last minute:</label>
                            <select class="form-control" name="last_minute">
                                <option value="0" {{ $travel->last_minute == 0 ? 'selected' : '' }}>nie</option>
                                <option value="1" {{ $travel->last_minute == 1 ? 'selected' : '' }}>tak</option>
                            </select>   
                        </div>
                        <button class="btn btn-primary" type="submit">Zapisz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
