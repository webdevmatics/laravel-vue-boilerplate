<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index($userId=0)
    {
        if($userId){
            $activities = Activity::with('causer', 'subject')->where('causer_id', $userId)->get();

        }else {
            $activities = Activity::with('causer', 'subject')->get();
        }

        return $activities;
    }
}
