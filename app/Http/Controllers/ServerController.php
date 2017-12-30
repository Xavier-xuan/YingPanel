<?php

namespace App\Http\Controllers;

use App\Models\Host;
use Illuminate\Http\Request;
use App\Models\Server;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ServerController extends Controller
{

    public function all()
    {
        $servers = Server::paginate(15);
        $hosts = Host::all(['id', 'name', 'ip']);
        return view('server.list', compact('servers', 'hosts'));
    }

    public function my()
    {
        $servers = Auth::user()->servers()->paginate(15);
        return view('server.list', compact('servers'));
    }

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        $data = $request->only(['name', 'host', 'port', 'expire', 'max_mem', 'max_hard_disk_capacity', 'max_cpu_utilizatio_rate']);

        // 常规数据验证
        $this->validator($data)->validate();

        // get host
        $host = Host::find($data['host']);

        // 处理数据
        unset($data['host']);
        $data['host_id'] = $host->id;

        $data['user_id'] = Auth::user()->id;
        $data['expire'] = strtotime($request->get('expire'));

        // 写入数据库
        $server = new Server($data);
        $server->save();
        $server->refresh();

        // 创建服务器
        $result = $host->host()->create($server);

        if ($result !== true){
            return back()->with('alert.errors', ['服务器创建失败，原因：' . $result]);
        }
        return back()->with('alert.successes', ['服务器创建成功！']);

    }

    /**
     * @param $data
     * @return mixed
     */
    public function validator($data)
    {
        return Validator::make($data, [
                'name' => 'required',
                'host' => 'required|exists:hosts,id',
                'port' => ['required',
                           'between:0,65535',/*
                            Rule::unique('servers')->where(function ($query) use ($data) {
                                $query->where('host_id', $data['host']);
                            })*/],
                'expire' => 'required|date_format:Y-m-d',
                'max_mem' => 'required|integer|min:0',
                'max_hard_disk_capacity' => 'required|integer|min:0',
                'max_cpu_utilizatio_rate' => 'required|integer|min:0',
            ]
        );
    }
}
