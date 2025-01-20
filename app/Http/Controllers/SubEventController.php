<?php

namespace App\Http\Controllers;

use App\Models\SubEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubEventController extends Controller
{
    public function __construct()
    {
        // // Hanya admin yang bisa mengakses CRUD
        // $this->middleware('admin')->except('index');
    }

    public function index()
    {
        $subEvents = SubEvent::all();
        return view('subevents.index', compact('subEvents'));
    }


    public function create()
    {
        return view('subevents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rules_file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/images', $imageName);
            $imageUrl = Storage::url($imagePath);
        } else {
            $imageUrl = null;
        }

        if ($request->hasFile('rules_file')) {
            $rulesFile = $request->file('rules_file');
            $rulesFileName = Str::random(10) . '.' . $rulesFile->getClientOriginalExtension();
            $rulesFilePath = $rulesFile->storeAs('public/rules', $rulesFileName);
            $rulesFileUrl = Storage::url($rulesFilePath);
        } else {
            $rulesFileUrl = null;
        }

        $subEvent = new SubEvent();
        $subEvent->name = $request->name;
        $subEvent->description = $request->description;
        $subEvent->category = $request->category;
        $subEvent->start_date = $request->start_date;
        $subEvent->end_date = $request->end_date;
        $subEvent->image = $imageUrl;
        $subEvent->rules_file = $rulesFileUrl;

        // if ($request->hasFile('image')) {
        //     $subEvent->image = $request->file('image')->store('images');
        // }

        // if ($request->hasFile('rules_file')) {
        //     $subEvent->rules_file = $request->file('rules_file')->store('rules');
        // }

        $subEvent->save();

        return redirect()->route('subevents.index')->with('success', 'Sub-Event created successfully.');
    }

    public function edit($id)
    {
        $subEvent = SubEvent::findOrFail($id);
        return view('subevents.edit', compact('subEvent'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rules_file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/images', $imageName);
            $imageUrl = Storage::url($imagePath);
        }

        if ($request->hasFile('rules_file')) {
            $rulesFile = $request->file('rules_file');
            $rulesFileName = Str::random(10) . '.' . $rulesFile->getClientOriginalExtension();
            $rulesFilePath = $rulesFile->storeAs('public/rules', $rulesFileName);
            $rulesFileUrl = Storage::url($rulesFilePath);
        }

        $subEvent = SubEvent::findOrFail($id);
        $subEvent->name = $request->name;
        $subEvent->description = $request->description;
        $subEvent->category = $request->category;
        $subEvent->start_date = $request->start_date;
        $subEvent->end_date = $request->end_date;
        $subEvent->image = $imageUrl;
        $subEvent->rules_file = $rulesFileUrl;

        // if ($request->hasFile('image')) {
        //     $subEvent->image = $request->file('image')->store('images');
        // }

        // if ($request->hasFile('rules_file')) {
        //     $subEvent->rules_file = $request->file('rules_file')->store('rules');
        // }

        $subEvent->save();

        return redirect()->route('subevents.index')->with('success', 'Sub-Event updated successfully.');
    }

    public function destroy(SubEvent $subevent)
    {
            // if ($subEvent->image) {
            //     Storage::disk('public')->delete($subEvent->image);
            // }

            // if ($subEvent->rules_file) {
            //     Storage::disk('public')->delete($subEvent->rules_file);
            // }

        // $subEvent->delete();

        $subevent->registrations()->delete();
        $subevent->delete();

        return redirect()->route('subevents.index')->with('success', 'Sub-Event deleted successfully.');
    }

    public function downloadRules($id)
    {
        $subEvent = SubEvent::findOrFail($id);

        $filePath = str_replace('/storage', '', $subEvent->rules_file);

        if ($subEvent->rules_file && Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        }

        return redirect()->back()->with('error', 'File peraturan tidak ditemukan.');
    }

}
