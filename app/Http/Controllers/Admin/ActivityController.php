<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Order by start_date when available, fall back to activity_date
        $activities = Activity::orderByRaw("COALESCE(start_date, activity_date) DESC")->paginate(20);
        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'activity_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after_or_equal:start_time',
            'recurring_daily' => 'nullable|boolean',
            'recurrence_type' => 'required|string|in:single,range,daily,weekdays',
            'weekdays' => 'nullable|array',
            'weekdays.*' => 'in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
        ]);

        // normalize recurring flags
        $data['recurring_daily'] = ($data['recurrence_type'] === 'daily');
        if(isset($data['weekdays']) && is_array($data['weekdays'])){
            // store weekdays array as-is; model casts to array
        } else {
            $data['weekdays'] = null;
        }

        Activity::create($data);
        return redirect()->route('activities.index')->with('success', __('Activity created'));
    }

    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'activity_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after_or_equal:start_time',
            'recurring_daily' => 'nullable|boolean',
            'recurrence_type' => 'required|string|in:single,range,daily,weekdays',
            'weekdays' => 'nullable|array',
            'weekdays.*' => 'in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
        ]);

        $data['recurring_daily'] = ($data['recurrence_type'] === 'daily');
        if(isset($data['weekdays']) && is_array($data['weekdays'])){
            // ok
        } else {
            $data['weekdays'] = null;
        }

        $activity->update($data);
        return redirect()->route('activities.index')->with('success', __('Activity updated'));
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success', __('Activity deleted'));
    }
}
