<?php

namespace App\Http\Controllers;

class HomeController extends Controller {

	public function home() {
        return view('home');
    }

    public function about() {
        return view('about');
    }

    public function templates() {
        return view('templates');
    }

    public function contact() {
        return view('contact');
    }
}
