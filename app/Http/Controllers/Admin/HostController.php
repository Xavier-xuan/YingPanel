<?php
/**
 * Created by Seth8277
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Host;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HostController extends Controller
{
    public function list()
    {
        $hosts = Host::paginate(15);
        return view('admin.host.list', compact('hosts'));
    }

    public function store(Host $host, Request $request)
    {
        $data = $request->only('name', 'ip', 'port', 'verify_code');
        if (is_null($data['name']))
            $data['name'] = $data['ip'] . ":" . $data['port'];

        // 校验数据
        $this->validator($data)->validate();

        // 填充到模型
        $host->fill($data);

        // 判断主机是否可用
        if (!$host->test()) {
            return back()->with('alert.errors', ['无法连接该主机！']);
        } else {
            $host->save();
            return back()->with('alert.successes', ['添加成功！']);
        }


    }

    public function delete(Host $host)
    {
        if ($host->delete()) {
            return back()->with('alert.successes', ['该主机已被删除！']);
        }else {
            return back()->with('alert.errors', ['删除失败']);
        }
    }

    protected function validator($data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'ip' => 'required|unique:hosts',
            'port' => 'required|between:0,65535',
            'verify_code' => 'required|string'
        ]);
    }
}