<?php

$getID3 = new getID3();

if (!function_exists('getAudioLength')) {
    function getAudioLength($filePath)
    {
        $getID3 = new getID3();
        $fileInfo = $getID3->analyze($filePath);

        if (isset($fileInfo['playtime_seconds'])) {
            return $fileInfo['playtime_seconds'];
        }

        return false;
    }
}
