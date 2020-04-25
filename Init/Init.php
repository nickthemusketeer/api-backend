<?php
namespace BackendAPI;

require "../vendor/autoload.php";

class Init {

    function run() {
        $errorhandler = new Error\Error();
        $apicheck = new API\ReceivedData($errorhandler);
        $filename = $apicheck->checkFile();
        $apianalysis = new API\Analysis($filename, $errorhandler);
        $apianalysis->analyseSound();
    }

}
