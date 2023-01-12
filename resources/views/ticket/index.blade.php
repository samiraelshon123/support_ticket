@extends('layouts.app')
@section('content')


    <main class="d-flex flex-nowrap">


        @include('layouts/sidebar')


        <div class="table-responsive col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <br>
            <h2>Ticket Table</h2><br>
            <form action="{{ route('ticket.index') }}" method="get">
                @csrf
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Category</label>
                            <select name="category" class="form-control" id="">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->title}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="">Status</label>
                            <select name="status" class="form-control" id="">
                                    <option value="">Select Status</option>
                                    <option value="0">Close</option>
                                    <option value="1">Open</option>

                            </select>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="">Priority</label>
                           <input type="text" class="form-control" name="priority" value="">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                </div>

            </form>
            @can("Add_Ticket")
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ms-auto">
                    <a class="btn btn-success me-5" href="{{route('ticket.create')}}">Add Ticket</a>
                </div>
            </div>
            @endcan
        <table class="table table-striped table-lg table-hover table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Categories</th>
                <th scope="col">Labels</th>
                <th scope="col">User</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tickets as $ticket)

            <tr>
                <td>{{$ticket->id}}</td>
                <td><a href="{{route("ticket.show",$ticket->id)}}">{{$ticket->title}}</a></td>
                <td class="px-4 py-3 text-sm">
                    @foreach($ticket->category as $category)
                        <span class="rounded-full bg-gray-50 px-2 py-2">{{ $category->title }}</span>
                    @endforeach
                </td>
                <td class="px-4 py-3 text-sm">

                    @foreach($ticket->label as $label)
                        <span class="rounded-full bg-gray-50 px-2 py-2">{{ $label->title }} </span>
                    @endforeach
                </td>
                <td>{{$ticket->user->name}}</td>
                <td>
                    <div class="d-flex order-actions">
                        @can("Update_Ticket")
                            <a href="{{route("ticket.edit",$ticket->id)}}" class=""><i class="fa-regular fa-pen-to-square"></i></a>
                        @endcan

                        @can("Delete_Ticket")

                            <a data-action="{{route("ticket.destroy",$ticket->id)}}" data-bs-toggle="modal" data-bs-target="#myModal" class="ms-3 open-deleteDialog"><i class="fa-solid fa-trash-can"></i></a>
                        @endcan
                    </div>
                </td>

            </tr>

            @endforeach
            </tbody>
        </table>
        </div>

    </main>
<x-delete-modal />
@endsection
