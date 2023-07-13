<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $categories = new Category;

        $categories->category = $request->category;
        $categories->save();

        return redirect()->route('categories');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('pages.category.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $categories = Category::find($id);

        $categories->category = $request->category;
        $categories->save();

        return redirect()->route('categories');
    }

    public function destroy($id)
    {

        $categories = Category::find($id);
        $categories->delete();

        return redirect()->route('categories');
    }
}
