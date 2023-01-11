<?php

namespace App\Http\Controllers;

use App\Http\Requests\label\UpdatelabelRequest;
use App\Http\Requests\Label\CreateLabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class LabelController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Add_Label', ['only' => ['create','store']]);
        $this->middleware('permission:Show_Label', ['only' => ['index','show']]);
        $this->middleware('permission:Update_Label', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete_Label', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Label::get();
        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $label = new Label();
        $action = route('label.store');
        return view('label.form', compact('action', 'label'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLabelRequest $request)
    {

        $data = $request->validated();
        if ($request->hasFile("image")){

            $data["image"] =  uploadImage($request->file("image"),"/assets/upload/label");
        }
        Label::create($data);
        return redirect()->route("label.index");
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

        $label = Label::find($id);
        $action = route('label.update', $id);
        return view('label.form', compact('action', 'label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatelabelRequest $request, $id)
    {
        $data = $request->validated();
        $label = Label::find($id);
        if ($request->hasFile("image")){

            $data["image"] =  uploadImage($request->file("image"),"/assets/upload/label");
        }
        $label->update($data);
        return redirect()->route("label.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);

        $label = Label::find($id);
        $label->delete();
        return redirect()->route("label.index");
    }
}
