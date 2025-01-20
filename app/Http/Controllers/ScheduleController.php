<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        // Define the categories
        $categories = ['ELVERO', 'STOVERO', 'MUSCOVERO', 'ACAVERO', 'FIDOVERO'];

        // Get the selected category from the request
        $selectedCategory = $request->input('category');

        // Query the schedules based on the selected category
        $query = Schedule::query();

        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }

        // Get the schedules and order by date
        $schedules = $query->orderBy('date')->get(); // Apply orderBy before get()

        // Pass the categories and selected category to the view
        return view('schedules.index', compact('schedules', 'categories', 'selectedCategory'));
    }

    public function create()
    {
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'team1' => 'nullable',
            'team2' => 'nullable',
            'location' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'team1' => 'nullable',
            'team2' => 'nullable',
            'location' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $schedule->update($request->all());

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
