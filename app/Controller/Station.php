<?php

namespace app\Controller;

use app\Core\Controller;
use app\Utility\NSAPI;

class Station extends Controller
{
    public function index()
    {
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->View->response = $this->requestStation();
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
        $this->View->addScript('/site/public/js/autoload_station.js');

        // Render the view
        $this->View->render('station', [
            'title' => 'Station checker',
            'text' => 'Kies een station en bekijk aankomende en vertrekkende treinen.',
            'stations' => $_SESSION['stationNames']
        ]);
    }

    private function requestStation()
    {
        // Request arrivals and departures and returns an array
        if (isset($_POST['station1_id']) && !empty($_POST['station1_id'])) {
            $s1 = $_POST['station1_id'];

            $arrivalsURL = "https://gateway.apiportal.ns.nl/reisinformatie-api/api/v2/arrivals";
            $departuresURL = "https://gateway.apiportal.ns.nl/reisinformatie-api/api/v2/departures";

            $params = [
                'uicCode' => $s1,
                //'maxJourneys' => '10',
            ];

            return  [
                'arrivals' => json_decode(NSAPI::get($arrivalsURL, $params)),
                'departures' => json_decode(NSAPI::get($departuresURL, $params))
            ];

        return false;
        }

        
    }
}