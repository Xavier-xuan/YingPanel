<?php
/**
 * Created by Seth8277
 */

namespace app\Http\Controllers\Admin;


use App\Facades\Setting as Setting_Facade;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function show(){
        $settings_data = Setting::all();
        $settings = collect();
        foreach ($settings_data as $k => $v){
            $settings->put($v->key, $v->value);
        }
        return view('admin.setting.index', compact('settings'));
    }

    public function store(Request $request){
        $data = $request->all();
        foreach ($data as $k => $v){
            if (!Setting_Facade::set($k, $v))
                back()->with('alert.warings', ['更新失败！']);
        }

        return back()->with('alert.successes', ['网站设置已更新！']);
    }
}