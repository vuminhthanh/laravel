<?php


namespace App\Http\Controllers;


use App\Models\Question;

class LandingPageController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('id','DESC')->get();
        return view('welcome')->with('questions', $questions);
    }
}
