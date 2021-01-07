define([
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function (Component, customerData) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();
            customerData.reload(['weather_weather_section'], true).done(function () {
                this.weatherWeatherSection = customerData.get('weather_weather_section');
                let weather = JSON.parse(this.weatherWeatherSection().user_data);

                document.getElementById('city-value').innerHTML = weather.weather_data.city;
                document.getElementById('temp-value').innerHTML = weather.weather_data.temperature;
            });
        }
    });
});
