<?php

namespace App\Models;

use FrozenSdk\FrozenGo;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{

    protected $hidden = ['verify_code'];

    protected $fillable = ['name', 'ip', 'port', 'verify_code'];

    /**
     * 该主机下的所有服务器
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servers(){
        return $this->hasMany(Server::class);
    }

    /**
     * 测试该主机是否可连接
     *
     * @return boolean
     */
    public function test(){
        return $this->host()->test();
    }

    public function host(){
        return app()->makeWith(\App\Contracts\Host::class,['host' => $this]);
    }
}
