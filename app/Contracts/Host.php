<?php
/**
 * Created by Seth8277
 */

namespace App\Contracts;


use App\Models\Server;

interface Host
{
    function test() :bool;

    function list();

    function create(Server $server);
}