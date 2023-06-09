<?php
# (c) PremierExpo 2022

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Models\Activity;

class LogsController extends Controller
{
    public function index()
    {
        $data['logs'] = Activity::sortable()->orderBy('created_at', 'DESC')->paginate(50);
        $data['total'] = $data['logs']->total();
        $data['log_names'] = Activity::select('log_name')->groupBy('log_name')->orderBy('log_name')->get();
        return view('config.logs.index', $data);
    }

    public function name( $name ) {
        $data['name'] = $name;
        $data['logs'] = Activity::sortable()->where('log_name',$name)->orderBy('created_at','DESC')->paginate(50);
        $data['total'] = $data['logs']->total();
        $data['log_names'] = Activity::select('log_name')->groupBy('log_name')->orderBy('log_name')->get();
        return view('config.logs.name', $data);
    }
}
