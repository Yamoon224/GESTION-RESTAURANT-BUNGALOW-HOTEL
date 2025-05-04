<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['created_by'] = $data['updated_by'] = auth()->id();
        Category::create( $data );

        return back()->with(['message'=>__('locale.save', ['param'=>__('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'y' : '', 'prefix'=>''])])]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except(['_token']);
        $category = Category::find($id);
        $category->update($data);

        return back()->with(['message'=>__('locale.update', ['param'=>__('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'y' : '', 'prefix'=>''])])]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();

        return back()->with(['message'=>__('locale.delete', ['param'=>__('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'y' : '', 'prefix'=>''])])]);
    }
}
