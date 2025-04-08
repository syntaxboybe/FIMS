<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the dashboard and redirect based on user role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('farmer')) {
            // If farmer has farms, show them, otherwise redirect to create a farm
            if ($user->farms()->exists()) {
                return redirect()->route('farmer.farms.index');
            } else {
                return redirect()->route('farmer.farms.create');
            }
        }

        // Fallback if role is not recognized
        return view('dashboard');
    }
}
