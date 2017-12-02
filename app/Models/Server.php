<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{

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
}
