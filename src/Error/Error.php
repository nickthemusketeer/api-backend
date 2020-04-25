<?php
namespace BackendAPI\Error;

class Error {

    function raiseError($errorcode, $errormessage) {
        http_response_code($errorcode);
        $openedfile = fopen("../logs/errorlog.txt", "a+");
        $towrite = $errormessage . "\n";
        fwrite($openedfile, $towrite);
        fclose($openedfile);
        exit();
    }

}