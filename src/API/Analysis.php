<?php
namespace BackendAPI\API;

class Analysis {

    function __construct($filename, $errorhandler) {
        $this->filename = $filename;
        $this->errorhandler = $errorhandler;
    }

    function analyseSound() {
        $cmd = "python3 ../bin/demo.py " . $this->filename;
        $output = shell_exec($cmd);
        $output = trim($output, "\n");
        if (is_numeric($output)) {
            $this->returnResult($output);
        } else {
            $this->errorhandler->raiseError(500, "Fatal: Script failed");
        }
    }

    private function returnResult($result) {
        $result = ["percentage" => $result];
        $jsonresult = json_encode($result);
        http_response_code(200);
        header('Content-Type: application/json');
        echo $jsonresult;
    }

}