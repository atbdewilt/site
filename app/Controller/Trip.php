<?php

namespace app\Controller;

use app\Core\Controller;
use app\Utility\NSAPI;

class Trip extends Controller
{
    public function index()
    {
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->View->response = $this->requestTrip();
        }

        // Check if stations names are stored in session
        if (!isset($_SESSION['stationNames']) || empty($_SESSION['stationNames'])) {
            $stationNames = [];
            $url = 'https://gateway.apiportal.ns.nl/reisinformatie-api/api/v2/stations';
            foreach (json_decode(NSAPI::get($url))->payload as $station) {
                $stationNames[] = [
                    'label' => $station->namen->lang,
                    'value' => $station->UICCode
                ];
            }
            $_SESSION['stationNames'] = $stationNames;
        }

        // Add css for jquery autoloader
        $this->View->addCSS('/site/jqueryui/themes/base/jquery-ui.css');

        // Add js scripts for jquery autoloader
        $this->View->addScript('/site/jquery/jquery.js');
        $this->View->addScript('/site/jqueryui/jquery-ui.js');

        // Add js script for jquery autoloader
        // Gets the list to compare input and fills in the form
        $this->View->addScript('/site/public/js/autoload_trip.js');

        // Render the view
        $this->View->render('trip', [
            'title' => 'Trip checker',
            'text' => 'Kies twee stations en bekijk welke ritten er zijn.',
            'stations' => $_SESSION['stationNames']
        ]);
    }

    private function requestTrip()
    {
        // Check for departure station
        if (isset($_POST['station1_id']) && !empty($_POST['station1_id'])) {
            $s1 = $_POST['station1_id'];
        }

        // Check for arrival station
        if (isset($_POST['station2_id']) && !empty($_POST['station2_id'])) {
            $s2 = $_POST['station2_id'];
        }

        // Request trips and returns an array
        if (!empty($s1) && !empty($s2)) {
            $url = 'https://gateway.apiportal.ns.nl/reisinformatie-api/api/v3/trips';
            $params = [
                'originUicCode' => $s1,
                'destinationUicCode' => $s2
            ];

            return json_decode(NSAPI::get($url, $params));
        }

        return false;
    }
}