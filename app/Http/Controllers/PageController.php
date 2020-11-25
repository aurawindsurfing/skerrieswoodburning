<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseTypeGroup;
use Cloudinary\Api;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use JD\Cloudder\Facades\Cloudder;

class PageController extends Controller {

    public function index()
    {
        $groups_chunks = Cache::remember('group_chunks', 1440, function () {
            return CourseTypeGroup::where('id', '<>', 14)->get()->sortBy('order')->take(16)->chunk(4);
        });
        $courses = Cache::remember('courses', 1440, function () {
            return Course::with(['venue', 'course_type'])->where('inhouse', false)->orderByDesc('date')->take(4)->get();
        });
        $logos = Cache::remember('logos', 1440, function () {
            return $this->cloudinary_resources('logos', 50, 'cloudinary_logo');
        });
        $image = Cache::remember('image', 1440, function () {
            return Arr::random($this->cloudinary_resources('pictures', 50, 'cloudinary_optimised_jpg'));
        });

        return view('welcome', compact('groups_chunks', 'courses', 'logos', 'image'));
    }

    public function group(CourseTypeGroup $group)
    {
        $courses = Cache::remember('courses', 1440, function () {
            return Course::with(['venue', 'course_type'])->where('inhouse', false)->orderByDesc('date')->take(30)->get();
        });

        return view('group', compact('group', 'courses'));
    }


    /**
     * @param String $path
     * @param Int $take
     * @param String $preset
     * @return array
     * @throws Api\GeneralError
     */
    private function cloudinary_resources(string $path, int $take, string $preset)
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
            $url = Str::replaceFirst('e_bgremoval', 'e_bgremoval', Cloudder::secureShow('cit/' . $url, config('settings.' . $preset)));
            array_push($items, $url);
        }

        if ($path !== 'logos')
        {
            $course_types = CourseTypeGroup::all();

            foreach ($course_types as $course)
            {
                if ($course->icon)
                {
                    array_push($items, Str::beforeLast(Cloudder::secureShow('' . $course->icon, config('settings.' . $preset)), '.'));
                }
            }
        }

        return $items;
    }
}
