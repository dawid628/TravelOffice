@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card myform">
                <div class="card-header text-primary">Dodawanie miasta</div>

                <div class="card-body">
                    <form class="p-3" method="POST" action="{{route('store-city')}}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Kraj:</label>
                            <select class="form-control" name="country_id" id="country" required>
                            </select>
                          </div>
                        <div class="form-group mb-3">
                            <label for="name">Nazwa:</label>
                            <input class="form-control" name="name" id="name" placeholder="Wpisz kraj" required>
                          </div>
                          <button class="btn btn-primary" type="submit">Zapisz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection