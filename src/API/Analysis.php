<?php
/**
 * This file is part of CoughDetect/api-backend (https://github.com/CoughDetect/api-backend).
 * Copyright (c) 2020. Jade Twining.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GPL-3.0-only.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License 3 for more details.
 *
 * You should have received a copy of the GNU General Public License 3
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

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