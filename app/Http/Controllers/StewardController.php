<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StewardController extends Controller
{
    public function index()
    {
        return redirect()->route('steward.stats');
    }

    public function stats()
    {
        // Fetch events for charts
        $events = \App\Models\EnergyEvent::with('user')
            ->where('zone_id', auth()->user()->zone_id)
            ->get();

        // Data for "Events Over Time" (grouped by day)
        $eventsOverTime = $events->groupBy(function($event) {
            return $event->created_at->format('Y-m-d');
        })->map->count();

        // Data for "Activity by User" (on/off count)
        $activityByUser = $events->groupBy('user.name')->map(function ($userEvents) {
            return [
                'on' => $userEvents->where('type', 'on')->count(),
                'off' => $userEvents->where('type', 'off')->count(),
            ];
        });

        return view('steward.stats', compact('eventsOverTime', 'activityByUser'));
    }

    public function users()
    {
        $users = \App\Models\User::where('zone_id', auth()->user()->zone_id)->get();
        return view('steward.users', compact('users'));
    }

    public function zones()
    {
        // Access zones typically via the authenticated user's scope or all if they manage a larger area.
        // For now assuming steward sees their own zone info or all zones if they are high level.
        // Based on current logic, they are tied to one zone_id.
        $zone = \App\Models\Zone::find(auth()->user()->zone_id); 
        return view('steward.zones', compact('zone'));
    }

    public function validation()
    {
        $query = \App\Models\EnergyEvent::with(['user', 'zone'])
            ->where('zone_id', auth()->user()->zone_id)
            ->where('status', 'pending');

        if (request()->has('type')) {
            $query->where('type', request('type'));
        }

        $events = $query->latest()
            ->take(20)
            ->get();

        return view('steward.validation', compact('events'));
    }
}
