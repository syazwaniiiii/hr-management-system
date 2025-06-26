<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Employee;
use App\Models\Schedule;

class ScheduleController extends Controller
{

    public function admin() {
        $staffList = Employee::select('id', 'name')->get();
        // You can also filter by role/active status if needed
        return Inertia::render('Schedule/AdminSchedule', [
            'staffList' => $staffList,
        ]);
    }

    public function employee() {
        // Fetch only the logged-in employee's schedule
        return Inertia::render('Schedule/MySchedule');
    }

    // Assign a staff to a shift (create or update)
    public function assign(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'shift_type' => 'required|in:morning,evening',
            'week_start' => 'required|date',
            'day' => 'required|date',
        ]);

        // Update or create the schedule assignment
        $schedule = Schedule::updateOrCreate(
            [
                'shift_type' => $validated['shift_type'],
                'week_start' => $validated['week_start'],
                'day' => $validated['day'],
            ],
            [
                'employee_id' => $validated['employee_id'],
            ]
        );

        return response()->json(['success' => true, 'schedule' => $schedule]);
    }

    // Fetch all assignments for a given week
    public function week(Request $request)
    {
        $weekStart = $request->query('week_start');
        if (!$weekStart) {
            return response()->json(['error' => 'week_start is required'], 400);
        }
        $schedules = Schedule::with('employee')
            ->where('week_start', $weekStart)
            ->get();

        // Format assignments for frontend: { 'YYYY-MM-DD': [morning_employee_id, evening_employee_id] }
        $assignments = [];
        foreach ($schedules as $schedule) {
            $day = $schedule->day;
            if (!isset($assignments[$day])) {
                $assignments[$day] = [null, null];
            }
            $idx = $schedule->shift_type === 'morning' ? 0 : 1;
            $assignments[$day][$idx] = $schedule->employee_id;
        }
        return response()->json(['assignments' => $assignments]);
    }

    // Reset all assignments for a given week
    public function reset(Request $request)
    {
        $request->validate([
            'week_start' => 'required|date',
        ]);
        \App\Models\Schedule::where('week_start', $request->week_start)->delete();
        return response()->json(['success' => true]);
    }
} 