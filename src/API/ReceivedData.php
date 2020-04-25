<?php
namespace BackendAPI\API;

class ReceivedData {
    private $file;
    private $errorhandler;

    function __construct($errorhandler) {
        $this->file = file_get_contents('php://input');
        $this->errorhandler = $errorhandler;
    }

    function checkFile() {
        $headers = getallheaders();
        $clength = $headers["Content-Length"];
        $clength = (int)$clength;
        if (strlen($this->file) !== $clength) {
            $this->errorhandler->raiseError(409, "Fatal: Content Length doesn't match");
        } else {
            $return = $this->writeFile();
            return $return;
        }
    }

    protected function writeFile() {
        $dir = "../resources/";
        $prefix = "cough";
        $extension = ".wav";
        $tempfilename = tempnam($dir, $prefix);
        $filename = $tempfilename . $extension;
        rename($tempfilename, $filename);
        $openedfile = fopen($filename, "w");
        fwrite($openedfile, $this->file);
        return $filename;
    }

}