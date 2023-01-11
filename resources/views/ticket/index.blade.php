@extends('layouts.app')
@section('content')


    <main class="d-flex flex-nowrap">


        @include('layouts/sidebar')


        <div class="table-responsive col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <br>
            <h2>Ticket Table</h2><br>
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

                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tickets as $ticket)

            <tr>
                <td>{{$ticket->id}}</td>
                <td><a href="{{route("ticket.show",$ticket->id)}}">{{$ticket->title}}</a></td>

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
