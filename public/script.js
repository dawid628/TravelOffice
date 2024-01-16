function GetCities() {
  $.get('/cities', function(data) {
      console.log(data);
      addCitiesToSelect(data);
  }).fail(function(error) {
      console.error(error);
  });
}

function getCountries(selectedCountryId) {
    $.get('/countries', function(data) {
        console.log(data);
        populateCountriesSelect(data, selectedCountryId);
    }).fail(function(error) {
        console.error(error);
    });
}

function populateCountriesSelect(countries, selectedCountryId) {
    var $select = $('#country');
    $select.empty();
  
    $.each(countries, function(index, country) {
        var $option = $('<option>', {
            value: country.id,
            text: country.name
        });

        $select.append($option);
    });

    if (selectedCountryId) {
        $select.val(selectedCountryId);
    }
    $select.selectpicker('refresh');
}

function addCitiesToSelect(cities) {
    var select = $("select[name='city_id']");
    if (select.length) {
        $.each(cities, function(index, city) {
            // Sprawdź, czy opcja o danym city.id już istnieje
            if (select.find('option[value="' + city.id + '"]').length === 0) {
                var option = $('<option>');
                option.val(city.id);
                option.text(city.country.name + ' - ' + city.name);
                select.append(option);
            }
        });
    }
}

function fetchCountriesForFilters() {
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

function fetchCitiesForFilters(countryId, callback) {
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

    const params = new URLSearchParams(window.location.search);
    
    const countryId = params.get('country_id');
    const cityId = params.get('city_id');
    const peopleCount = params.get('places');
    const dateFrom = params.get('date_from');
    const lastMinute = params.get('last_minute');
    const allInclusive = params.get('all_inclusive');

    if (countryId) {
    document.querySelector('select[name="country_id"]').value = countryId;
    fetchCitiesForFilters(countryId, (cities) => {
        if (cityId) {
            document.querySelector('select[name="city_id"]').value = cityId;
        }
    });
}

    if (peopleCount) {
        document.querySelector('input[name="places"]').value = peopleCount;
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