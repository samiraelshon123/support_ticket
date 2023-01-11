<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $total_tickets = count(Ticket::get());
        return view('dashboard', compact('total_tickets'));
    }
}
