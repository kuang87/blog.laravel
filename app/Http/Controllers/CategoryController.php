<?php


namespace App\Http\Controllers;


use App\Category;
use Illuminate\Http\Request;

class CategoryController
{
    public function index()
    {
        return view('admin/category/index', ['categories' => Category::latest()->get()]);
    }

    public function create()
    {
        return view('admin/category/form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories',
            'slug' => 'required|unique:categories|max:255',
        ]);
        $category = new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->save();

        return redirect()->route('category.index')->with('message', 'Категория ' . $data['title'] . ' создана');
    }

    public function show(Category $category)
    {

    }

    public function edit(Category $category)
    {
        return view('admin/category/form', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories,title,' . $category->id . ',id',
            'slug' => 'required|unique:categories,slug,' .$category->id . ',id|max:255',
        ]);

        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->save();

        return redirect()->route('category.index')->with('message', 'Категория ' . $data['title'] . ' отредактирована');
    }

    public function destroy(Category $category)
    {
        $title = $category->title;
        $category->delete();
        return redirect()->route('category.index')->with('message', 'Категория ' . $title . ' удалена');
    }
}