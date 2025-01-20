<?php

namespace App\Http\Controllers;

use App\Models\Registration; 
use Illuminate\Http\Request;

class ParticipantsController extends Controller
{
    public function index(Request $request)
    {
        $categories = ['ELVERO', 'STOVERO', 'MUSCOVERO', 'ACAVERO', 'FIDOVERO'];
        $selectedCategory = $request->input('category');

        // Fetch registrations based on selected category
        $registrations = Registration::when($selectedCategory, function ($query) use ($selectedCategory) {
            return $query->where('category', $selectedCategory);
        })->get();

        return view('participants.index', compact('registrations', 'categories', 'selectedCategory'));
    }
}
