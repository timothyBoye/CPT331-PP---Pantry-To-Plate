<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class AboutController
 *
 * Provides functionality for displaying the about page for Pantry to Plate
 *
 * @package App\Http\Controllers
 */
class AboutController extends Controller
{
    /**
     * Displays the About page which explains who we are and what we do
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('about');
    }
}
