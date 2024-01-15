@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('management') }}" class="btn btn-primary mb-3">Powrót</a>
            <div class="card myform">
                <div class="card-header">Dodawanie miasta</div>
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
                            <input class="form-control" name="name" id="name" placeholder="Wpisz nazwe" required>
                          </div>
                          <button class="btn btn-primary" type="submit">Zapisz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var $cityCountryId = $('#city_country_id');
    
    if ($cityCountryId.length) {
        var selectedCountryId = $cityCountryId.val();
        getCountries(selectedCountryId);
    } else {
        getCountries();
    }
    
    GetCities();
});
</script>