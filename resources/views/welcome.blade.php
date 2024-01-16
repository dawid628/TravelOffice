@extends('layouts.app')
@php
    use Carbon\Carbon;
    use App\Models\Country;
@endphp
@section('content')
<div class="container">
    <form action="{{ route('index') }}" method="GET">
        <div class="row mb-3">
            <div class="col">
                <select name="country_id" class="form-control">
                    <option value="">Wybierz kraj</option>
                </select>
            </div>
            <div class="col">
                <select name="city_id" class="form-control">
                    <option value="">Wybierz miasto</option>
                </select>
            </div>
            <div class="col">
                <input type="number" name="places" class="form-control" placeholder="Ilość osób">
            </div>
            <div class="col">
                <input type="date" name="date_from" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="form-check">
                    <input type="checkbox" name="last_minute" class="form-check-input" id="lastMinuteCheck" value="1">
                    <label class="form-check-label" for="lastMinuteCheck">Last Minute</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="all_inclusive" class="form-check-input" id="allInclusiveCheck" value="1">
                    <label class="form-check-label" for="allInclusiveCheck">All Inclusive</label>
                </div>
            </div>
            <div class="col">
                <select name="sort_by" class="form-control">
                    <option value="">Sortuj</option>
                    <option value="price_asc">Cena rosnąco</option>
                    <option value="price_desc">Cena malejąco</option>
                    <option value="date_from_nearest">Data wyjazdu od najbliższej</option>
                    <option value="date_from_farthest">Data wyjazdu od najdalszej</option>
                </select>
            </div>
<div class="col">
    <button type="submit" class="btn btn-primary">Filtruj</button>
    <a href="/" class="btn btn-primary">Wyczyść</a>
</div>
</div>
</form>

    @foreach ($travels as $travel)
    @if(Carbon::parse($travel->date_from)->isToday() || Carbon::parse($travel->date_from)->isFuture())
        <div class="card mb-3 border">
            <div class="row g-0 align-items-center">
                <div class="col-md-6">
                    <img src="{{ Storage::url($travel->photo_path) }}" class="img-fluid rounded m-1" alt="{{ $travel->name }}" style="width: 100%; height: 400px;">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title">{{ $travel->name }}</h5>
                        <p class="card-text">{{ $travel->description }}</p>
                        <p class="card-text"><small class="text-muted">{{ Country::find($travel->city->country_id)->name 
                            . ' - ' . $travel->city->name }}</small></p>
                        <p class="card-text">Data wyjazdu: {{ $travel->date_from }} do {{ $travel->date_to }}</p>
                        <p class="card-text">{{ $travel->places }} miejsc dostępnych</p>
                        <p class="card-text">Last minute: {{ $travel->last_minute ? 'tak' : 'nie' }}</p>
                        <p class="card-text">All inclusive: {{ $travel->all_inclusive ? 'tak' : 'nie' }}</p>
                        <p class="card-text">Cena: {{ number_format($travel->price, 2) }} zł</p>
                        @auth
                        <form method="POST" action="{{ route("book") }}" onsubmit="return validatePlaces({{ $travel->places }}, this);">
                            @csrf
                            <input type="hidden" name="travel_id" value="{{ $travel->id }}">
                            <label for="places_{{ $travel->id }}">Liczba miejsc:</label>
                            <input type="number" id="places_{{ $travel->id }}" name="headcount" min="1" max="{{ $travel->places }}" required>
                            <button type="submit" class="btn btn-primary">Rezerwuj</button>
                        </form>
                        @else
                            <p class="card-text"><a href="login">Zaloguj się</a>, aby zarezerwować</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @endif
        @endforeach
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    fetchCountries();
    const countrySelect = document.querySelector('select[name="country_id"]');
    countrySelect.addEventListener('change', function() {
        fetchCities(this.value);
    });

    setFormValuesFromUrl();
});

    
    function fetchCountries() {
        fetch('/countries')
            .then(response => response.json())
            .then(data => {
                updateCountrySelect(data);
                setFormValuesFromUrl();
            })
            .catch(error => console.error('Error fetching countries:', error));
    }
    
    function updateCountrySelect(countries) {
        const select = document.querySelector('select[name="country_id"]');
        select.innerHTML = '<option value="">Wybierz kraj</option>'; // Reset and add default option
    
        countries.forEach(country => {
            const option = document.createElement('option');
            option.value = country.id;
            option.textContent = country.name;
            select.appendChild(option);
        });
    }
    
    function fetchCities(countryId, callback) {
    fetch('/cities')
        .then(response => response.json())
        .then(allCities => {
            const filteredCities = allCities.filter(city => city.country_id == countryId);
            updateCitySelect(filteredCities);
            if (typeof callback === "function") {
                callback(filteredCities);
            }
        })
        .catch(error => console.error('Error fetching cities:', error));
}

    
    function updateCitySelect(cities) {
        const select = document.querySelector('select[name="city_id"]');
        select.innerHTML = '<option value="">Wybierz miasto</option>'; // Reset and add default option
    
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city.id;
            option.textContent = city.name;
            select.appendChild(option);
        });
    }

    function setFormValuesFromUrl() {
        const countrySelect = document.querySelector('select[name="country_id"]');
        const citySelect = document.querySelector('select[name="city_id"]');

        const params = new URLSearchParams(window.location.search);
        
        const countryId = params.get('country_id');
        const cityId = params.get('city_id');
        const peopleCount = params.get('people_count');
        const dateFrom = params.get('date_from');
        const lastMinute = params.get('last_minute');
        const allInclusive = params.get('all_inclusive');

        if (countryId) {
        document.querySelector('select[name="country_id"]').value = countryId;
        fetchCities(countryId, (cities) => {
            if (cityId) {
                document.querySelector('select[name="city_id"]').value = cityId;
            }
        });
    }

        if (peopleCount) {
            document.querySelector('input[name="people_count"]').value = peopleCount;
        }

        if (dateFrom) {
            document.querySelector('input[name="date_from"]').value = dateFrom;
        }

        if (lastMinute) {
            document.querySelector('input[name="last_minute"]').checked = true;
        }

        if (allInclusive) {
            document.querySelector('input[name="all_inclusive"]').checked = true;
        }
    }

    function validatePlaces(availablePlaces, form) {
    const requestedPlaces = form.querySelector('[name="places"]').value;
    if (requestedPlaces > availablePlaces) {
        alert(`Maksymalna dostępna ilość miejsc to ${availablePlaces}.`);
        return false;
    }
    return true; 
}
    </script>
    