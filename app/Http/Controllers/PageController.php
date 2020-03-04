<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseTypeGroup;
use Cloudinary\Api;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use JD\Cloudder\Facades\Cloudder;

class PageController extends Controller {

    public function index()
    {
        $groups_chunks = CourseTypeGroup::all()->sortBy('order')->take(9)->chunk(3);
        $courses = Course::with(['venue', 'course_type'])->where('inhouse', false)->orderByDesc('date')->take(10)->get();
        $logos = $this->cloudinary_resources('logos', 50, 'cloudinary_logo');
        $image = Arr::random($this->cloudinary_resources('pictures', 50, 'cloudinary_optimised_jpg'));

        return view('welcome', compact('groups_chunks', 'courses', 'logos', 'image'));
    }

    public function group(CourseTypeGroup $group)
    {

        $courses = Course::with(['venue', 'course_type'])->where('inhouse', false)->orderByDesc('date')->take(10)->get();
        return view('group', compact('group', 'courses'));
    }


    /**
     * @param String $path
     * @param Int $take
     * @param String $preset
     * @return array
     * @throws Api\GeneralError
     */
    private function cloudinary_resources(String $path, Int $take, String $preset)
    {
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
                "prefix"      => "cit/" . $path,
                "max_results" => $take,
            ]
        );

        $items = [];

        foreach ($response['resources'] as $resource)
        {
            $url = Str::after(Str::beforeLast($resource['secure_url'], '.'), 'cit');
            $url = Str::replaceFirst('e_bgremoval', 'e_bgremoval/e_grayscale', Cloudder::secureShow('cit/' . $url, config('settings.' . $preset)));
            array_push($items, $url);
        }

        return $items;
    }
}
