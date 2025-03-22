<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all(); // Fetch all categories from the database
        return view('admin.categories', compact('categories')); // Pass categories to the view
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.add-category'); // Display the add category form
    }

    /**
     * Store a newly created category in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        // Create and save the new category
        Category::create([
            'name' => $request->input('name'),
        ]);

        // Redirect to the categories list with a success message
        return redirect()->route('admin.categories')->with('success', 'Category added successfully!');
    }
}