<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{


    // Display all categories
    public function index()
    {

        $request = request();

        $categories = Category::with('parent')->withCount('products')->search($request->query())->latest()->paginate(10);

        return view('dashboard.categories.index', compact('categories'));
    }



    // Display the category creation form
    public function create()
    {
        $parents = Category::all();

        // Create an empty category instance to be used in the creation form
        $category = new Category();

        return view('dashboard.categories.create', compact('parents', 'category'));
    }



    // Store a new category in the database
    public function store(CategoryRequest $request) //used a custom request for validation the data
    {
        // Generate a slug for the category based on its name
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        $data = $request->except('image');

        // Upload and store the image if provided
        $data['image'] = $this->uploadImage($request);

        Category::create($data);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category added successfully');
    }



    // Display the details of a specific category  
    public function show(string $id)
    {
        $category = Category::with('products')->findOrFail($id);
        $products =    $category->products;

        return view('dashboard.categories.show', compact('category', 'products'));
    }




    // Display the category editing form
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        // Get all parent categories except the current one (prevent self-referencing)
        $parents = Category::where('id', '!=', $id)->where(function ($query) use ($id) {
            $query->whereNull('parent_id')->orWhere('parent_id', '!=', $id);
        })->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }



    // Update a category in the database
    public function update(CategoryRequest $request, string $id) //used a custom request for validation the data
    {



        $category = Category::findOrFail($id);

        $data = $request->except('image');

        $new_img = $this->uploadImage($request);

        if ($new_img) {
            $data['image'] = $new_img;
        }



        // Delete the old image if a new image is provided
        $old_img = $category->image;

        if ($old_img && $new_img) {

            Storage::disk('public')->delete($old_img);
        }

        $category->update($data);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully');
    }



    // Delete a category from the database
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);


        // Delete the associated image from storage

        // if ($category->image) {
        //     $category->delete();
        //     Storage::disk('public')->delete($category->image);
        // }

        // // Delete the category from the database if there is no image

        $category->delete();


        return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully');
    }




    // Upload the image and return its path
    public function uploadImage(Request $request)
    {
        // Check if an image is present in the request
        if (!$request->has('image')) {
            return;
        }

        // Upload the image and store it in the public/uploads directory
        $image = $request->image;
        $path = $image->store('uploads', 'public');
        return $path;
    }

    public function showTrash()
    {
        $categories = Category::onlyTrashed()->paginate();

        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restoreTrash($category)
    {
        $category = Category::onlyTrashed()->findOrFail($category);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')->with('success', 'category restored');
    }


    public function deleteTrash($category)
    {
        $category = Category::onlyTrashed()->findOrFail($category);
        // Delete the associated image from storage

        if ($category->image) {
            $category->forceDelete();
            Storage::disk('public')->delete($category->image);
        }

        // Delete the category from the database if there is no image

        $category->forceDelete();

        return redirect()->route('dashboard.categories.trash')->with('success', 'category Deleted');
    }
}
