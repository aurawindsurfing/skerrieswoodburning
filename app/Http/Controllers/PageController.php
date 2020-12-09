<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseType;
use App\CourseTypeGroup;
use Cloudinary\Api;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use JD\Cloudder\Facades\Cloudder;

class PageController extends Controller {

    public function index()
    {
        $groups_chunks = Cache::remember('group_chunks', 86400, function () {
            return CourseTypeGroup::where('id', '<>', 14)->get()->sortBy('order')->chunk(4);
        });
        $courses = Cache::remember('courses', 86400, function () {
            return Course::with(['venue', 'course_type'])->where('course_type_id', 1)->where('inhouse', false)->where('date', '>', today())->orderBy('date')->take(7)->get();
        });
        $logos = Cache::remember('logos', 86400, function () {
            return $this->cloudinary_resources('logos', 50, 'cloudinary_logo');
        });
        $image = Cache::remember('image', 86400, function () {
            return Arr::random($this->cloudinary_resources('pictures', 50, 'cloudinary_optimised_jpg'));
        });

        return view('welcome', compact('groups_chunks', 'courses', 'logos', 'image'));
    }

    public function group(CourseTypeGroup $group)
    {
        $course_types = $group->course_types()->orderBy('order')->get();

        $course_type_ids = CourseType::where('course_type_group_id', $group->id)->pluck('id');

        $courses = Cache::remember('group_courses'.$group->id, 86400, function () use ($course_type_ids) {
            return Course::with(['venue', 'course_type'])
                ->whereIn('course_type_id', $course_type_ids)
                ->where('date', '>', today())
                ->where('inhouse', false)
                ->orderBy('date')
                ->get();
        });

        return view('group', compact('group', 'course_types', 'courses'));
    }

    public function list(CourseType $type = null)
    {
        $courses = Course::query()
                ->when(isset($type), function ($query) use ($type) {
                    return $query->where('course_type_id', $type->id);
                })
                ->when(!isset($type), function ($query) use ($type) {
                    return $query->whereNotIn('course_type_id', [1]);
                })
                ->with(['venue', 'course_type'])
                ->where('inhouse', false)
                ->where('date', '>', today())
                ->orderBy('date')
                ->get();

        $course_type = $type;

        return view('list', compact('courses', 'course_type'));
    }

    public function bespoke(CourseType $type = null)
    {
        return view('bespoke', compact('type'));
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

            foreach ($course_types as $course_type)
            {
                if ($course_type->icon)
                {
                    array_push($items, Str::beforeLast(Cloudder::secureShow('' . $course_type->icon, config('settings.' . $preset)), '.'));
                }
            }
        }

        return $items;
    }
}
