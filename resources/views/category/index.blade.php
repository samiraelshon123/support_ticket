@extends('layouts.app')
@section('content')

    <main class="d-flex flex-nowrap">


        @include('layouts/sidebar')


        <div class="table-responsive col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <br>
            <h2>Category Table</h2><br>
            @can("Add_Category")

            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ms-auto">
                    <a class="btn btn-success me-5" href="{{route('category.create')}}">Add Category</a>
                </div>
            </div>
            @endcan
        <table class="table table-striped table-lg table-hover table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)


            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->title}}</td>
                <td><img src= "{{ $category->image_for_web }}" class="img"/>  </td>
                <td>
                    <div class="d-flex order-actions">
                        @can("Update_Category")
                            <a href="{{route("category.edit",$category->id)}}" class=""><i class="fa-regular fa-pen-to-square"></i></a>
                        @endcan

                        @can("Delete_Category")

                            <a data-action="{{route("category.destroy",$category->id)}}" data-bs-toggle="modal" data-bs-target="#myModal" class="ms-3 open-deleteDialog"><i class="fa-solid fa-trash-can"></i></a>
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
