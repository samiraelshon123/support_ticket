@extends('layouts.app')
@section('content')

    <main class="d-flex flex-nowrap">


        @include('layouts/sidebar')


        <div class="table-responsive col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <br>
            <h2>User Table</h2><br>

            @can("Add_User")
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ms-auto">
                    <a class="btn btn-success me-5" href="{{route('user.create')}}">Add User</a>
                </div>
            </div>
            @endcan
        <table class="table table-striped table-lg table-hover table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Type</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)

            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{ $user->email }}</td>
                <td>{!! $user->type_name !!}</td>
                <td>
                    <div class="d-flex order-actions">
                        @can("Update_User")
                            <a href="{{route("user.edit",$user->id)}}" class=""><i class="fa-regular fa-pen-to-square"></i></a>
                        @endcan

                        @can("Delete_User")

                            <a data-action="{{route("user.destroy",$user->id)}}" data-bs-toggle="modal" data-bs-target="#myModal" class="ms-3 open-deleteDialog"><i class="fa-solid fa-trash-can"></i></a>
                        @endcan
                    </div>
                </td>
            </tr>

            @endforeach
            </tbody>
        </table>
        </div>
        <x-delete-modal />
    </main>
    <x-delete-modal />
@endsection
