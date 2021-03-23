    <h1 class="text-center">Enter an IP Address:</h1>
    <div class="input-group input-group-lg w-25 mx-auto clearfix mb-5">
        <span class="input-group-text" id="inputGroup-sizing-lg">IP Address</span>
        <input type="text" class="form-control mb-0 text-center" id="ip-entry" aria-label="ip-address-entry" aria-describedby="inputGroup-sizing-lg" value="<?= $user_ip ?>">
    </div>
    <div class="container" style="max-width: 1140px;">
        <div class="row justify-content-center mt-3">
            <div class="card w-25 gx-0 mx-2">
                <div class="card-header text-center">Latitude</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center mb-0"><?= $user_coords[0] ?></li>
                </ul>
            </div>
            <div class="card w-25 gx-0 mx-2">
                <div class="card-header text-center">Longitude</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center mb-0"><?= $user_coords[1] ?></li>
                </ul>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <h2 class="text-center mt-5">Weather Forecast for <?php echo $weather['title'] . ', ' . $weather['parent']['title']; ?></h2>
            <?php for ($i = 0; $i < 5; $i++) :
            $day = $weather['consolidated_weather'][$i]; ?>
            <div id="weather-details" class="card col px-0 mx-1" style="width: 20%;">
                <div class="card-header text-center"><?= $day['applicable_date'] ?></div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item high-low text-center">
                        <span class="text-primary"><?= round($day['min_temp'], 1) * (9/5) + 32 ?> °F</span> / <span class="text-danger"><?= round($day['max_temp'], 1) * (9/5) + 32 ?> °F</span>
                        <br />
                        <img src="https://www.metaweather.com/static/img/weather/<?= $day['weather_state_abbr'] ?>.svg" alt="Weather Icon" title="" width="50" height="50" class="py-2">
                    </li>
                    <li class="list-group-item details">
                        <p>Details: <strong><?= $day['weather_state_name'] ?></strong></p>
                        <p>Humidity: <strong><?= $day['humidity'] ?></strong> %</p>
                        <p>Wind: <strong><?= round($day['wind_speed'], 1) ?></strong> mph</p>
                        <p>Pressure: <strong><?= $day['air_pressure'] ?></strong> mbar</p>
                    </li>
                </ul>
            </div>
            <?php endfor; ?>
        </div>
    </div>
    <?php

