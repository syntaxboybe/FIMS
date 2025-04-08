<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\Livestock;
use App\Models\HealthRecord;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the farmer dashboard with statistics and farm information.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $farms = $user->farms()->with(['livestock', 'health_records'])->get();

        // Calculate total livestock across all farms
        $total_livestock = $farms->sum(function ($farm) {
            return $farm->livestock->count();
        });

        // Calculate total health records across all farms
        $total_health_records = $farms->sum(function ($farm) {
            return $farm->health_records->count();
        });

        return view('farmer.dashboard', compact(
            'farms',
            'total_livestock',
            'total_health_records'
        ));
    }
}
