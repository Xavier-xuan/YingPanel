<?php

namespace App\Contracts;

interface Setting {

    CONST CAN = 0;

    CONST CANNOT = -1;

    function can(String $key) :bool;

    function get(String $key, $default);

    function set(String $key, $value);

    function drop(String $key);
}