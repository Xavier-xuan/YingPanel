<?php
/**
 * Created by Seth8277
 */

namespace App\Services;


use App\Contracts\Host as HostContract;
use App\Models\Host;
use App\Models\Server;
use FrozenSdk\FrozenGo;
use \Exception;

class FrozenService implements HostContract
{
    private $Frozen;

    public function __construct(Host $host)
    {
        $this->Frozen = new FrozenGo($host->ip, $host->port, $host->verify_code);
    }

    public function test(): bool
    {
        try {
            $result = $this->Frozen->getServerList()->count() > -1;
        } catch (Exception $exception) {
            $result = false;
        }
        return $result;
    }

    public function list()
    {
        return $this->Frozen->getServerList();
    }


    /**
     * 创建服务器
     * 成功返回 true，失败返回错误信息
     * 写的时候被这段代码恶心到了
     *
     * @param Server $server
     * @return bool|mixed
     */
    public function create(Server $server)
    {
        // 元数据
        $data = [
            'MaxCpuRate' => $server->max_cpu_utilizatio_rate,
            'MaxMem' => $server->max_mem,
            'Executable' => $server->executable,
            'MaxHardDiskCapacity' => $server->max_hard_disk_capacity,
            'Name' => $server->name,
            'Expire' => $server->expire,
            'MaxHardDiskWriteSpeed' => $server->max_hard_disk_write_speed,
            'MaxHardDiskReadSpeed' => $server->max_hard_disk_read_speed,
            'MaxUnusedUpBandwidth' => $server->max_unused_up_bandwidth,
            'MaxUsingUpBandwidth' => $server->max_using_up_bandwidth,
        ];

        $config = [];
        // 转换成服务端能处理的方式
        foreach ($data as $k => $v) {
            if (is_int($v))
                $v = (string)$v;
            $piece = [
                'AttrName' => $k,
                'AttrValue' => $v
            ];

            $config[] = $piece;
        }

        try {
            $result = $this->Frozen->createServer($server->id, $server->name);
            if ($result->get('Status') != 0) {
                return $result->get('message');
            }

            $result = $this->Frozen->setServerConfig($server->id, $config);

            if ($result->get('status') != 0) {
                return $result->get('message');
            }

        } catch (Exception $exception) {
            return "Internet error";
        }

        return true;
    }

    public function setServerConfig($id, $config)
    {
        return $this->Frozen->setServerConfig($id, $config);
    }
}