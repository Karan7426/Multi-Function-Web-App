<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use getID3;

class Functions extends BaseController
{
    public function __construct()
    {
        helper(['distance', 'audio']);
    }

    public function calculateDistanceExample()
    {
        $lat1 = 40.748817;
        $lon1 = -73.985428;
        $lat2 = 34.052235;
        $lon2 = -118.243683;

        $distance = calculateDistance($lat1, $lon1, $lat2, $lon2);

        echo "The distance between the points is: " . $distance . " km";
    }

    public function getAudioLengthExample($filePath)
    {
         
        $fullPath = FCPATH . 'uploads/' . $filePath;

        
       // echo "Full Path: " . $fullPath . "<br>";

        if (file_exists($fullPath)) {
            $audioLength = getAudioLength($fullPath);

            if ($audioLength !== false) {
                echo "The audio length is: " . $audioLength . " seconds";
            } else {
                echo "Failed to get the audio length.";
            }
        } else {
            echo "File does not exist.";
        }
    }
}
