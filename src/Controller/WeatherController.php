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
    public function index()
    {
//        if (!$path) {
//            return $this->redirect('/');
//        }
//        if (in_array('..', $path, true) || in_array('.', $path, true)) {
//            throw new ForbiddenException();
//        }
//        $page = $subpage = null;
//
//        if (!empty($path[0])) {
//            $page = $path[0];
//        }
//        if (!empty($path[1])) {
//            $subpage = $path[1];
//        }
//        $this->set(compact('page', 'subpage'));

        // Get user's IP address as a default
        $user_ip = $this->request->clientIp();

        // Grab lat/lon coords from IP address
        $user_coords = $this->getUserCoords($user_ip);
        //$this->set(compact('user_coords'));
        $this->set('user_coords', $user_coords);

        // Get current weather for those lat/lon coords
        return $this->render('weather');
    }


    public function view($id = null)
    {

        return $this->render('weather');

    }

    private function getUserCoords($user_ip): array
    {
        /**
         * Latitude / Longitude Coordinates from IP
         *
         * This function will return [lat, lon] when provided an IP address
         *
         * @link https://freegeoip.app
         */

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://freegeoip.app/json/" . $user_ip,
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
            // The call was successful, sending back coords
            $response_arr = json_decode($response, true);
            $response = array($response_arr['latitude'], $response_arr['longitude']);
            return $response;
        }
    }

}
