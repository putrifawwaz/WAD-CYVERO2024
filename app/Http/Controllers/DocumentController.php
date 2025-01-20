<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            // Store the image in the 'public/documentations' directory
            $imagePath = $image->storeAs('documentations', $imageName, 'public');
            // Get the URL for the stored image
            $imageUrl = Storage::url($imagePath);
        } else {
            $imageUrl = null;
        }

        // Create the document with the image URL
        Document::create([
            'category' => $request->category,
            'link' => $request->link,
            'image' => $imageUrl,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document added successfully.');
    }

    public function edit(Document $document)
    {
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Make image optional for update
        ]);

        $document->category = $request->category;
        $document->link = $request->link;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('documentations', $imageName, 'public');
            $document->image = Storage::url($imagePath);
        }

        $document->save(); // Save the updated document

        return redirect()->route('documents.index')->with('success', 'Document updated successfully.');
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }
}
