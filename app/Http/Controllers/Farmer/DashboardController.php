<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\Livestock;
use App\Models\HealthRecord;
use App\Models\LivestockCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        // Get farms with relationships preloaded
        $farms = $user->farms()
            ->with(['livestock.category', 'livestock.healthRecords'])
            ->withCount(['livestock', 'health_records'])
            ->latest()
            ->get();

        // Calculate total livestock across all farms
        $total_livestock = $farms->sum('livestock_count');

        // Calculate total health records across all farms
        $total_health_records = $farms->sum('health_records_count');

        // Get recent livestock (limited to 5)
        $recent_livestock = Livestock::whereHas('farm', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with(['farm', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // Get recent health records (limited to 5)
        $recent_health_records = HealthRecord::whereHas('livestock.farm', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with(['livestock.farm'])
            ->latest()
            ->take(5)
            ->get();

        // Get upcoming health records (due within next 7 days)
        $upcoming_health_checks = HealthRecord::whereHas('livestock.farm', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->whereNotNull('follow_up_date')
            ->where('follow_up_date', '>=', Carbon::today())
            ->where('follow_up_date', '<=', Carbon::today()->addDays(7))
            ->with(['livestock.farm'])
            ->orderBy('follow_up_date')
            ->take(5)
            ->get();

        // Get livestock by category statistics
        $livestock_by_category = [];
        if ($total_livestock > 0) {
            $livestock_by_category = Livestock::join('livestock_categories', 'livestocks.livestock_category_id', '=', 'livestock_categories.id')
                ->join('farms', 'livestocks.farm_id', '=', 'farms.id')
                ->where('farms.user_id', $user->id)
                ->select('livestock_categories.name', DB::raw('count(*) as total'))
                ->groupBy('livestock_categories.name')
                ->orderBy('total', 'desc')
                ->get();
        }

        // Get health records by type statistics
        $health_records_by_type = [];
        if ($total_health_records > 0) {
            $health_records_by_type = HealthRecord::join('livestocks', 'health_records.livestock_id', '=', 'livestocks.id')
                ->join('farms', 'livestocks.farm_id', '=', 'farms.id')
                ->where('farms.user_id', $user->id)
                ->select('record_type', DB::raw('count(*) as total'))
                ->groupBy('record_type')
                ->orderBy('total', 'desc')
                ->get();
        }

        return view('farmer.dashboard', compact(
            'farms',
            'total_livestock',
            'total_health_records',
            'recent_livestock',
            'recent_health_records',
            'upcoming_health_checks',
            'livestock_by_category',
            'health_records_by_type'
        ));
    }
}
