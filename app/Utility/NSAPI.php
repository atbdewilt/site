<?php

namespace app\Utility;

class NSAPI
{
    // Key to connect to NS API
    private static $headers = [
        'Ocp-Apim-Subscription-Key: e5920fad186b4abdb302f749135d7c1f'
    ];

    public static function get($url, $params = [])
    {
        // Initiate client URL
        $curl = curl_init();

        // Bind params to the URL like the GET method (?id=1&...)
        if ($params) {
            $url .= '?' . http_build_query($params);
        }

        // Set options for client URL (url, header, ...)
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, self::$headers);

        // Execute request and close connection
        $result = curl_exec($curl);
        curl_close($curl);

        // Return request or error
        if ($e = curl_error($curl)) {
            return $e;
        } else {
            return $result;
        }
    }

    /* Shit to display requests */
    public static function convertToDateTime($dateTime)
    {
        return date('Y-m-d H:i', strtotime($dateTime));
    }

    public static function convertToTime($dateTime)
    {
        return date('H:i', strtotime($dateTime));
    }

    public static function htmlTrip($trips)
    {
        echo '<p>Er zijn ' . count($trips) . ' ritten gevonden</p>';

        foreach ($trips as $trip) {
            $origin = $trip->legs[0]->origin;
            $destination = array_reverse($trip->legs)[0]->destination;

            echo "<h3>Optie " . $trip->idx + 1 . ": <i>{$origin->name}</i> naar <i>{$destination->name}</i> (<u>" . self::convertToTime($origin->plannedDateTime) .  "</u> - <u>" . self::convertToTime($destination->plannedDateTime) . "</u>)</h3>";
            foreach ($trip->legs as $leg) {
                echo "<p>";
                echo "Trein <b>{$leg->name}</b> richting <i>{$leg->direction}</i>";
                echo "<br>";
                echo "Van <i>{$leg->origin->name}</i> naar <i>{$leg->destination->name}</i>";
                echo "<br>";
                echo "<u>" . self::convertToTime($leg->origin->plannedDateTime) . "</u> ";
                echo "<br>";
                foreach ($leg->stops as $stop) {
                    if (!empty($stop->name)) {
                        if ($stop->name !== $leg->stops[0]->name) {
                            echo "|<br>";
                            echo "|<br>";
                        }
                        echo "|- {$stop->name}<br>";
                    }
                }
                echo "<u>" . self::convertToTime($leg->destination->plannedDateTime) . "</u> ";
                echo "<p>";
            }
        }
    }
}