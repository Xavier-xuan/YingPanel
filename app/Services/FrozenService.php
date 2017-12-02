<?php
/**
 * Created by Seth8277
 */

namespace App\Services;


use App\Contracts\Host as BaseHost;
use App\Models\Host;
use FrozenSdk\FrozenGo;
use \Exception;

class FrozenService implements BaseHost
{
    private $Frozen;
    public function __construct(Host $host)
    {
        $this->Frozen = new FrozenGo($host->ip, $host->port, $host->verify_code);
    }

    public function test() :bool
    {
        try{
            $result = $this->Frozen->getServerList()->count() > -1;
        }catch (Exception $exception){
            $result = false;
        }
        return $result;
    }

    public function list()
    {
        return $this->Frozen->getServerList();
    }
}