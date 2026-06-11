<?php
namespace App\Http\Controllers;

class GuestController extends Controller
{
    public function __construct() {}

    public function interviewAssessment()
    {
        $title = "Form Builder";
        return view('form', compact('title'));
    }
}
