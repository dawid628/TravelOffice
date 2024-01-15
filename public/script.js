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