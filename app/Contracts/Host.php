<?php
/**
 * Created by Seth8277
 */

namespace App\Contracts;


interface Host
{
    function test() :bool;

    function list();
}