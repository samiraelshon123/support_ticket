<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Add_Category', ['only' => ['create','store']]);
        $this->middleware('permission:Show_Category', ['only' => ['index','show']]);
        $this->middleware('permission:Update_Category', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete_Category', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        $action = route('category.store');
        return view('category.form', compact('action', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {

        $data = $request->validated();
        if ($request->hasFile("image")){

            $data["image"] =  uploadImage($request->file("image"),"/assets/upload/category");
        }
        Category::create($data);
        return redirect()->route("category.index");
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

        $category = Category::find($id);
        $action = route('category.update', $id);
        return view('category.form', compact('action', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $data = $request->validated();
        $category = Category::find($id);
        if ($request->hasFile("image")){

            $data["image"] =  uploadImage($request->file("image"),"/assets/upload/category");
        }
        $category->update($data);
        return redirect()->route("category.index");
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
        $category->delete();
        return redirect()->route("category.index");
    }
}
