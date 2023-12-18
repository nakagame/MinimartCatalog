<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProductController extends Controller
{   
    const LOCAL_FOLDER_PATH = 'public/images/';
    private $product;

    public function __construct(Product $product) {
        $this->product = $product;
    }

    public function index() {
        $all_products = $this->product->orderBy('section_id')->orderBy('name')->get();

        return view('products.index')->with('all_products', $all_products);
    }

    public function create() {
        $all_sections = Section::all();

        return view('products.create')->with('all_sections', $all_sections);
    }

    public function store(Request $request) {
        $request->validate([
            'section'     => 'required',
            'name'        => 'required|min:1|max:50',
            'description' => 'required|min:1',
            'price'       => 'required|numeric|min:0.01',
            'image'       => 'mimes:jpeg,jpg,png,gif|max:1048'
        ]);

        $this->product->user_id  = Auth::user()->id;

        $this->product->section_id  = $request->section;
        $this->product->name        = $request->name;
        $this->product->description = $request->description;
        $this->product->price       = $request->price;

        if($request->image) {
            $this->product->image = $this->saveImage($request);
        }

        $this->product->save();

        return redirect()->route('index');
    }

    public function show($id) {
        $product = $this->product->findOrFail($id);
        return view('products.show')->with('product', $product);
    }

    private function saveImage($request) {
        $img_name = time(). '.'. $request->image->extension();
        $request->image->storeAs(self::LOCAL_FOLDER_PATH, $img_name);

        return $img_name;
    }

    public function edit($id) {
        $product = $this->product->findOrFail($id);
        $all_sections = Section::all();

        return view('products.edit')
            ->with('product', $product)
            ->with('all_sections', $all_sections);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'section'     => 'required',
            'name'        => 'required|min:1|max:50',
            'description' => 'required|min:1',
            'price'       => 'required|numeric|min:0.01',
            'image'       => 'mimes:jpeg,jpg,png,gif|max:1048'
        ]);

        $product = $this->product->findOrFail($id);

        $product->name        = $request->name;
        $product->description = $request->description;
        $product->price       = $request->price;
        $product->section_id  = $request->section;

        if($request->image) {
            $this->deleteImage($product->image);
            $product->image = $this->saveImage($request);
        }

        $product->save();

        return redirect()->route('index');
    }

    public function destroy($id) {
        $this->product->destroy($id);
        return redirect()->route('index');
    }

    private function deleteImage($image_name) {
        $image_name = self::LOCAL_FOLDER_PATH. $image_name;

        if(Storage::disk('local')->exists($image_name)) {
            Storage::disk('local')->delete($image_name);
        }
    }
}


