@extends('layouts.app')
@section('content')

    <main class="d-flex flex-nowrap">
    <h1 class="visually-hidden">Sidebars examples</h1>

        @include('layouts/sidebar')

        <div class="container">
    <main>
        <div class="py-5">
        <h2>Ticket form</h2>
        </div>

        <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
        </div>
        <div class="col-md-7 col-8">
            <form action="{{$action}}" method="post" class="needs-validation" enctype="multipart/form-data" >
                @if($ticket->id != null)
                @method("put")

            @endif
        @csrf
            <div class="row g-3">


                <div class="col-6">
                <label for="username" class="form-label">Title</label>
                <div class="input-group has-validation">

                    <input type="text" class="form-control" value="{{$ticket->title}}" name="title" id="title" placeholder="Enter Title" required>

                </div>
                </div>

                <div class="col-6">
                <label for="email" class="form-label">Message</label>
                <textarea name="description" id="" class="form-control">{{$ticket->description}}</textarea>
                </div>

                <div class="col-6">
                <label for="address" class="form-label">Labels</label><br>
                @foreach ($labels as $key => $label)
                    <input type="checkbox" name="label[]" value="{{$label->id}}" {{($ticket->id != null  && $label->id == $ticket->label[$key]["id"]) ? "checked" : "" }}>
                    <label for="">{{$label->title}}</label>
                @endforeach
                </div>

                <div class="col-6">

                    <label for="address" class="form-label">Categories</label><br>
                    @foreach ($categories as $category)
                        <input type="checkbox" name="category[]" value="{{$category->id}}" {{($ticket->id != null  && $category->id == $ticket->category[$key]["id"]) ? "checked" : "" }}>
                        <label for="">{{$category->title}}</label>
                    @endforeach

                </div>

{{--
                <div class="col-6">
                    <label for="">Priority</label>
                    <input type="text" value=""  name="priority[]" data-role="tagsinput" width="100%" >
                </div> --}}

                <div class="col-6">
                    <label for="">Priority</label>
                    <input type="text" name="priority" value="{{$ticket->priority}}" width="100%" >
                </div>
                @if($ticket->id != null)
                @can("Assign_Agent")

                    <div class="col-6">
                        <label for="name" class="form-label">Assign Agent:</label>
                    <select class="form-control" name="agent" id="">
                        <option value="" >Select Agent</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}" {{($ticket->agent_id == $user->id) ? "selected" : "" }}>{{$user->name}}</option>
                        @endforeach

                    </select>
                    </div>

                @endcan

                @endif
                <div class="col-6">
                    <label for="files">Select files:</label>
                    <input type="file" id="files" class="form-control" name="file[]" multiple><br><br>
                </div>
                <div class="col-12">
            <button class="btn btn-success w-25 " type="submit">Submit</button>
                </div>
            </form>
        </div><br><br><br>
        </div>
    </main>

    </div>

    </main>
@endsection



