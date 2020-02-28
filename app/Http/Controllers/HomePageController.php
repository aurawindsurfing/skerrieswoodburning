<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseType;
use Cloudinary\Api;
use Illuminate\Support\Str;
use JD\Cloudder\Facades\Cloudder;

class HomePageController extends Controller {

    public function index()
    {
        $course_type_chunks = CourseType::all()->take(9)->chunk(3);

        $upcoming_public_courses = Course::with(['venue', 'course_type'])->where('inhouse', false)->orderByDesc('date')->take(10)->get();

        \Cloudinary::config([
            "cloud_name" => env('CLOUDINARY_CLOUD_NAME'),
            "api_key"    => env('CLOUDINARY_API_KEY'),
            "api_secret" => env('CLOUDINARY_API_SECRET'),
            "secure"     => true,
        ]);

        $c = new Api();

        $response = $c->resources(
            [
                "type"        => "upload",
                "prefix"      => "cit/logos",
                "max_results" => 50,
            ]
        );

        $logos = [];

        foreach ($response['resources'] as $resource)
        {
            $url = Str::after(Str::beforeLast($resource['secure_url'], '.'), 'cit');
            $url = Str::replaceFirst('e_bgremoval', 'e_bgremoval/e_grayscale', Cloudder::secureShow('cit/' . $url, config('settings.cloudinary_logo')));
            array_push($logos, $url);
        }

//        return $logos;

        return view('welcome', compact('course_type_chunks', 'upcoming_public_courses', 'logos'));
    }
}
