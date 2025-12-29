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

    public function giftToken(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'token_type' => 'required|in:est,pat',
            'amount' => 'required|integer|min:1|max:1000',
        ]);

        $user = \App\Models\User::findOrFail($request->user_id);

        // Verify the user is in the steward's zone
        if ($user->zone_id !== auth()->user()->zone_id) {
            return back()->with('error', 'You can only gift tokens to users in your zone.');
        }

        // Update the appropriate token balance
        if ($request->token_type === 'est') {
            $user->increment('est_tokens', $request->amount);
            $tokenName = 'EST (Energy Steward Token)';
        } else {
            $user->increment('pat_tokens', $request->amount);
            $tokenName = 'PAT (Power Access Token)';
        }

        return back()->with('success', "Successfully gifted {$request->amount} {$tokenName} to {$user->name}!");
    }
}
