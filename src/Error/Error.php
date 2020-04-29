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