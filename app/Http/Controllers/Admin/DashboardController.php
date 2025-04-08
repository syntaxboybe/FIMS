<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Farm;
use App\Models\Livestock;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard with statistics.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_farmers' => User::whereHas('roles', function($query) {
                $query->where('name', 'farmer');
            })->count(),
            'total_farms' => Farm::count(),
            'total_livestock' => Livestock::count(),
            'recent_users' => User::with('roles')
                ->latest()
                ->take(5)
                ->get(),
            'recent_farms' => Farm::with('user')
                ->latest()
                ->take(5)
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
