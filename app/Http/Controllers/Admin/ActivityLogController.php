<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    //
    public function index()
    {
        $data = [
            'logs' => Activity::latest()->get()
        ];

        return view('activity-log.index', $data);
    }
}
