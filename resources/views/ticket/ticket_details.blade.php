@extends('layouts.app')
@section('content')


    <main class="d-flex flex-nowrap">


        @include('layouts/sidebar')


        <div class="table-responsive col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <br>
            <h2>Ticket Details</h2><br>
            <div class="card" style="width: 50rem;">

                <div class="card-body">
                  <h5 class="card-title">{{$ticket->title}}</h5>
                  <p class="card-text">{{$ticket->description}}</p>
                </div><hr>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <h5 class="card-title">Comments</h5>
                        @foreach ($ticket->comment as $comment)
                        <li class="list-group-item">{{$comment->comment}}</li>
                        @endforeach

                    </ul>
                </div>
                <hr>
                <div class="card-body">
                    <h5 class="card-title">Add Comment</h5>
                    <form action="{{route('add_comment', $ticket->id)}}" method="post">
                        @csrf

                        <textarea name="comment" class="form-control mb-4" id="" ></textarea>
                        <button type="submit" class="btn btn-success">Add</button>
                    </form>
                </div>
              </div>

        </div>

    </main>
<x-delete-modal />
@endsection
