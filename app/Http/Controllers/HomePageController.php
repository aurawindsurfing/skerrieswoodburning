<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseType;

class HomePageController extends Controller {

    public function index()
    {
        $course_type_chunks = CourseType::all()->take(9)->chunk(3);

        $upcoming_public_courses = Course::with(['venue', 'course_type'])->where('inhouse', false)->orderByDesc('date')->take(10)->get();

//        return $upcoming_public_courses;

        return view('welcome', compact('course_type_chunks', 'upcoming_public_courses'));
    }
}
