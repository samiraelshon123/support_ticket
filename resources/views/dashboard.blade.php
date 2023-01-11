@extends('layouts.app')
@section('content')
    <main class="d-flex flex-nowrap">

          @include('layouts/sidebar')
          <div class="column pt-5">
          <div class="">
            <span class="fs-3 ps-3 pt-6 mt-4 ">Dashboard</span>
          </div><br>
          <div class="">
            <span class="fs-5 text-black-50 ps-3 pt-6 mt-4 ps-5">  <i class="fa-solid fa-ticket text-bg-danger"></i> Total Tickets</span><br>
            <span class="fs-2 ps-4 ms-5 fw-bold">{{$total_tickets}}</span>
        </div>
    </div>

    </main>
@endsection
