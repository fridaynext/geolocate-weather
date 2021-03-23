    <h1 class="text-center">Enter an IP Address:</h1>
    <div class="input-group input-group-lg w-75 mx-auto clearfix mb-3">
        <span class="input-group-text" id="inputGroup-sizing-lg">IP Address</span>
        <input type="text" class="form-control mb-0" id="ip-entry" aria-label="ip-address-entry" aria-describedby="inputGroup-sizing-lg">
    </div>
    <div class="container">
        <div class="row justify-content-center">
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
        <div class="row justify-content-center">
            <div id="weather-details" class="card col px-0 mx-1" style="width: 20%;">
                <div class="card-header text-center">
                    Weather for <?= $user_ip ?>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item high-low text-center">
                        <span class="text-primary"> °F</span> / <span class="text-danger"> °F</span>
                        <br />
                        <img src="" alt="Weather Icon" title="" width="50" height="50">';
                    </li>
                    <li class="list-group-item details"></li>
                </ul>
            </div>
        </div>
        <?php

    echo "Your IP: " . $user_ip . '<br>';
    echo "Weather info: ";
    print_r($weather); ?>
    </div>

    <?php

