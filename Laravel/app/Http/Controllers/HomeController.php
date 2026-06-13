<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home.index');
    }

    public function about() {
        return view('home.about');
    }

    public function program() {
        return view('home.program');
    }

    public function programSD() {
        return view('home.program_sd');
    }

    public function programSMP() {
        return view('home.program_smp');
    }

    public function programSMA() {
        return view('home.program_sma');
    }

    public function pricing() {
        return view('home.pricing');
    }

    public function contact() {
        return view('home.contact');
    }
    
}