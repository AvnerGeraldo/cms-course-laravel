<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;

//Models
use App\Model\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index')->with('listCategories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        //Save Category
        Category::create([
            'name' => $request->name
        ]);

        //Session Message
        session()->flash('success', 'Category created sucessfully!');

        //Redirect
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoryRequest $request, Category $category)
    {
        //Update Category
        /*
         * First way
        $category->name = $request->name;

        $category->save();
        */
        #Second way
        $category->update([
            'name' => $request->name
        ]);

        //Flash Message
        session()->flash('success', 'Category updated successfully!');

        //Redirect
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //Delete Category
        $category->delete();

        //Flash Message
        session()->flash('success', 'Category deleted successfully!');

        //Redirect
        return redirect(route('categories.index'));
    }
}
