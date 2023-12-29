$(document).ready(function() {
    var $cityCountryId = $('#city_country_id');
    
    if ($cityCountryId.length) {
        var selectedCountryId = $cityCountryId.val();
        getCountries(selectedCountryId);
    } else {
        getCountries();
    }
    
    GetCities();
});

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
    if ($("select[name='city_id']").length) {
        $.each(cities, function(index, city) {
            var option = $('<option>');
            option.val(city.id);
            option.text(city.country.name + ' - ' + city.name);
            $("select[name='city_id']").append(option);
        });
    }
}