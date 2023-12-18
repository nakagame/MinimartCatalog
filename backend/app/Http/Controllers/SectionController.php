<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Product;

class SectionController extends Controller
{
    protected $section;

    public function __construct(Section $section)
    {
        $this->section = $section;
    }

    public function index() {
        $all_sections   = $this->section->all();
        
        return view('sections.index')->with('all_sections', $all_sections);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:1|max:50'
        ]);

        $this->section->name = $request->name;
        $this->section->save();

        return redirect()->back();
    }

    public function destroy($id) {
        // Find the section
        $section = $this->section->findOrFail($id);

        // Update foreign key references in the products table to null
        Product::where('section_id', $section->id)->update(['section_id' => null]);

        // Delete the record from the sections table
        $section->delete();

        return redirect()->back();
    }
}
