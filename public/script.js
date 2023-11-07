$(document).ready(function() {
    
    getCountries();
    GetCities();
});

function getCountries() {
    $.get('/countries', function(data) {
        console.log(data);
        populateCountriesSelect(data);
    }).fail(function(error) {
        console.error(error);
    });
}

function GetCities() {
  $.get('/cities', function(data) {
      console.log(data);
      addCitiesToSelect(data);
  }).fail(function(error) {
      console.error(error);
  });
}

function populateCountriesSelect(countries) {
    var $select = $('#country');
    $select.empty();
  
    $.each(countries, function(index, country) {
      $select.append($('<option>', {
        value: country.id,
        text: country.name
      }));
    });
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