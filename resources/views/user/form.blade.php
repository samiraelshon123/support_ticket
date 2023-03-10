
@extends('layouts.app')
@section('content')

    <main class="d-flex flex-nowrap">

        @include('layouts/sidebar')

        <div class="container">
    <main>
        <div class="py-5">
        <h2>User form</h2>
        </div>

        <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
        </div>
        <div class="col-md-7 col-8">
            <form action="{{$action}}" method="post" class="needs-validation" enctype="multipart/form-data" >
                @if($user->id != null)
                        @method("put")

                    @endif
                @csrf

            <div class="row g-3">


                <div class="col-12">
                <label for="name" class="form-label">Name</label>
                <div class="input-group has-validation">

                    <input type="text" class="form-control" name="name" value="{{old('name', $user->name)}}" id="title" placeholder="Enter Name" >

                </div>
                @if($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
                </div>
                <div class="col-12">
                    <label for="name" class="form-label">Email</label>
                    <div class="input-group has-validation">

                    <input type="email" class="form-control" name="email" value="{{old('email', $user->email)}}" id="title" placeholder="Enter Email" >

                    </div>
                    @if($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
                </div>
                <div class="col-12">
                    <label for="name" class="form-label">Password</label>
                    <div class="input-group has-validation">

                    <input type="password" class="form-control" name="password"  id="title" placeholder="Enter Password" >

                    </div>
                    @if($errors->has('password'))
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                @endif
                </div>

                <div class="col-12">
                    <label for="name" class="form-label">Type</label>

                <select class="form-control" name="type" id="">
                    <option value="" >Select Type</option>
                    <option value="0" {{($user->type === 0) ? "selected" : "" }} >Regular User</option>
                    <option value="1" {{($user->type === 1) ? "selected" : "" }}>Agent</option>
                    <option value="2" {{($user->type === 2) ? "selected" : "" }}>Adminstrator</option>
                </select>
                </div>
                @if($errors->has('type'))
                    <div class="text-danger">{{ $errors->first('type') }}</div>
                @endif
            <button class="btn btn-success w-25" type="submit">Submit</button>
            </form>
        </div><br><br><br>
        </div>
    </main>

    </div>

    </main>

    @endsection

