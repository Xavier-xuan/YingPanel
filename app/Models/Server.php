<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Server
 *
 * @property-read \App\Models\Host $host
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class Server extends Model
{
    protected $fillable = ['name', 'max_cpu_utilizatio_rate', 'max_mem', 'max_hard_disk_capacity', 'expire', 'user_id', 'host_id'];

    /**
     * 该服务器的所有者
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }


    /**
     * 该服务器所在的主机
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function host(){
        return $this->belongsTo(Host::class);
    }

    public function getStatusText(){
        $text = [
            -1 => '错误',
            0  => '未运行',
            1  => '运行中',
            2  => '启动中',
        ];
        if(key_exists($this->status, $text)){
            return $text[$this->status];
        }else{
            return "未知";
        }
    }
}
