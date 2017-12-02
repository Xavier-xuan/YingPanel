<?php
/**
 * Created by Seth8277
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class OverviewController extends Controller
{
    function index(){
        return view('admin.overview.index');
    }

}