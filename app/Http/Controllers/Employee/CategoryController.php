<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    private $types = array('women', 'men', 'kids');

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.categories.index')->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.categories.create')->with('types', $this->types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:255',
            'type' => 'required'
        ]);
        $category = new Category();
        $category->create($request->all());

        return redirect()->route('employee.categories.index')->with('success', 'You have successfully added a category');
        
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
    public function edit($id)
    {
        return view('employee.categories.edit')->with(['category' => Category::findOrFail($id), 'types' => $this->types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:255',
            'type' => 'required'
        ]);
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('employee.categories.index')->with('success', 'You have successfully updated a category');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category->delete()) {
            return redirect()->route('employee.categories.index')->with('success', 'You have successfully deleted a category');
        }
        return redirect()->route('employee.categories.index')->with('danger', 'Category not deleted');
    }

    public function getCategories ()
    {
        return response([
            'status' => 'OK',
            'categories' => Category::all()
        ], 200);
    }
}
