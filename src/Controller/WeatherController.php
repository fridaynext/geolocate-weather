<?php

namespace App\Controller;


use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use App\Controller\AppController;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class WeatherController extends AppController
{
    /*
     * Displays the view for the home page
     */
    public function view()
    {
        /******** IP ADDRESS ********/
        // Get user's IP address as a default
        //$user_ip = $this->request->clientIp(); // TODO: will use in production
        //$this->set('user_ip', $user_ip);       // TODO: will use in production
        $user_ip = '98.144.69.34';
        $this->set('user_ip', $user_ip);

        // Grab lat/lon coords from IP address
        $args = array(
            'url' => 'https://freegeoip.app/json/',
            'url_params' => $user_ip
        );
        $response = $this->apiCall($args);
        // set IP to 'null' if unsuccessful
        $user_coords = $response ? array($response['latitude'], $response['longitude']) : null;
        $this->set('user_coords', $user_coords);

        /******** WEATHER ********/
        // Get list of closest locations for the previously attained IP coordinates
        $args = array(
            'url' => 'https://www.metaweather.com/api/location/search/?lattlong=',
            'url_params' => $user_coords[0] .",". $user_coords[1]
        );
        $locations = $this->apiCall($args);
        // Query for weather at first location in list
        $args = array(
            'url' => 'https://www.metaweather.com/api/location/',
            'url_params' => $locations[0]['woeid']
        );
        $weather = $this->apiCall($args);
        print_r($weather);die();
        $this->set('weather', $locations[0]['woeid']);

        // Render the weather view template
        return $this->render('weather');
    }

    private function apiCall($args)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $args['url'] . $args['url_params'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            return false;
        } else {
            // The call was successful, return the response
            return json_decode($response, true);
        }
    }

    private function getWeather($lat_lon)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.metaweather.com/api/location/search/?lattlong=". $lat_lon[0] .",". $lat_lon[1],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // The call was successful, use closest location (first in list) to find weather
            $response_arr = json_decode($response, true);

            return $response_arr;
        }
    }

}
