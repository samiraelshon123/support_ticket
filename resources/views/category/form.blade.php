
@extends('layouts.app')
@section('content')
  

    <main class="d-flex flex-nowrap">


        @include('layouts/sidebar')

        <div class="container">
        <main>
            <div class="py-5">
            <h2>Category form</h2>
            </div>

            <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
            </div>
            <div class="col-md-7 col-8">
                <form action="{{$action}}" method="post" class="needs-validation" enctype="multipart/form-data">
                    @if($category->id != null)
                            @method("put")

                        @endif
                    @csrf
                <div class="row g-3">


                    <div class="col-12">
                    <label for="username" class="form-label">Title</label>
                    <div class="input-group has-validation">

                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="{{$category->title}}" required>

                    </div>
                    </div>


                    <div class="col-md-12">
                        <label for="image-upload" class="form-label">Image</label>
                        <div id="image-preview" class="product_image">
                            <input  class="form-control" type="file" name="image" id="image-upload" class="" />
                        </div>
                    </div>

                <button class="btn btn-primary w-25" type="submit">Submit</button>
                </form>
            </div><br><br><br>
            </div>
        </main>

        </div>

    </main>

@endsection
