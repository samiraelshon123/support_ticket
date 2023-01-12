<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\CreateTicketRequest;
use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\File;
use App\Models\Label;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketFile;
use App\Models\TicketLabel;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;

use function PHPSTORM_META\type;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Add_Ticket', ['only' => ['create','store']]);
        $this->middleware('permission:Show_Ticket', ['only' => ['index','show']]);
        $this->middleware('permission:Update_Ticket', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete_Ticket', ['only' => ['destroy']]);
        $this->middleware('permission:Assign_Agent', ['only' => ['assign_agent']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {

        $user = Auth::user();
        $categories = Category::get();
        $tickets = Ticket::
        when($user->type == 2, fn($query)=> $query)->
        when($user->type == 0, fn($query)=> $query->where('user_id', auth()->user()->id))->
        when($user->type == 1, fn($query)=> $query->where('agent_id', auth()->user()->id))->
        when($request->has('status'), function ($query) use ($request) {
                 return $query->where('status', $request->input('status'));
        })->
        when($request->has('priority'), function ($query) use ($request) {
            return $query->where('priority', $request->input('priority'));
   })->
        when($request->has('category'), function ($query) use ($request) {
                return $query->whereRelation('category', 'title', $request->input('category'));
        })->

        get();



    return view('ticket.index', compact('tickets', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $action = route('ticket.store');
        $ticket = new Ticket();
        $categories = Category::get();
        $labels = Label::get();
        return view('ticket.form', compact('ticket', 'categories', 'labels', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTicketRequest $request)
    {

        $data = $request->Validated();
        $data['user_id'] = auth()->user()->id;
        $ticket1 = Ticket::create($data);
        $ticket = Ticket::with('file', 'label', 'category')->find($ticket1->id);

       $files = [];
        if($request->file != null){

          if(count($request->file ) > 0){

              foreach($request->file as $file){

                  $file = uploadImage($file,"/assets/upload/file");
                  $file_ticket = File::create(['title'=> $file]);
                  array_push($files, $file_ticket->id);

              }
          }
        }

       $ticket->file()->attach($files);
       $ticket->label()->attach($request->label);
       $ticket->category()->attach($request->category);

          return redirect()->route('ticket.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::with('comment')->find($id);

        return view('ticket.ticket_details', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::where('type', 1)->get();
        $action = route('ticket.update', $id);
        $ticket = Ticket::with('label', 'file', 'category')->find($id);


        $categories = Category::get();
        $labels = Label::get();
      
        return view('ticket.form', compact('ticket', 'categories', 'labels', 'action', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, $id)
    {
        $data = $request->Validated();
        if($request->agent != null){
            $data['agent_id'] = $request->agent;
        }
        $ticket = Ticket::with('label', 'file', 'category')->find($id);
        $ticket->update($data);

        $files = [];
        if($request->file != null){
            for($i = 0 ; $i < count($ticket->file) ; $i++){
                $ticket->file[$i]->delete();
            }
          if(count($request->file ) > 0){

              foreach($request->file as $key=>$file){

                $file = uploadImage($file,"/assets/upload/file");
                $file_ticket = File::create(['title'=> $file]);
                array_push($files, $file_ticket->id);

              }
          }
          $ticket->file()->sync($files);
        }

        $ticket->label()->sync($request->label);
        $ticket->category()->sync($request->category);


        return redirect()->route('ticket.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::with('file', 'label', 'category', 'comment')->find($id);
        for($i = 0 ; $i < count($ticket->file) ; $i++){
            $ticket->file[$i]->delete();
        }

        $ticket->delete();
        return redirect()->route('ticket.index');
    }
    public function assign_agent(Request $request, $id){

        $ticket = Ticket::find($id);
        $ticket->update(['user_id' => $request->agent]);
        return redirect()->route('ticket.index');
    }
    public function add_comment(Request $request, $id){
        $ticket = Ticket::find($id);
        $comment =Comment::create(['comment' => $request->comment]);
        $ticket->comment()->attach($comment->id);
        return redirect()->back();
    }

}
