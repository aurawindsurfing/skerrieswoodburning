<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Course;
use App\CourseType;
use App\CourseTypeGroup;
use App\Venue;
use Cloudinary\Api;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use JD\Cloudder\Facades\Cloudder;

class PageController extends Controller
{
    public function index()
    {

        $photos = [
            [
                'path' => '/images/christmas-tree.jpg',
                'title' => 'Christmas Coasters'
            ],
            [
                'path' => '/images/nice-robin.jpg',
                'title' => 'Colorful Ornaments'
            ],
            [
                'path' => '/images/nice-santa.jpg',
                'title' => 'Pencil Cases'
            ],
        ];

        return view('welcome', compact('photos'));
    }

    public function group(CourseTypeGroup $group)
    {
        $course_types = $group->course_types()->orderBy('order')->get();
        $course_type_ids = CourseType::where('course_type_group_id', $group->id)->pluck('id');
        $courses = Cache::remember('group_courses'.$group->id, 900, function () use ($course_type_ids) {
            return $this->filterOutSomeFullyBookedCourses(
                Course::with(['venue', 'course_type'])
                    ->whereIn('course_type_id', $course_type_ids)
                    ->where('date', '>', today())
                    ->where('inhouse', false)
                    ->orderBy('date')
                    ->get(), 10);
        });

        return view('group', compact('group', 'course_types', 'courses'));
    }

    public function list(CourseType $type = null)
    {

        $courses = $this->filterOutSomeFullyBookedCourses(
            Course::query()
                ->when(isset($type), function ($query) use ($type) {
                    return $query->where('course_type_id', $type->id);
                })
                ->when(! isset($type), function ($query) {
                    return $query->whereNotIn('course_type_id', [1]);
                })
                ->with(['venue', 'course_type'])
                ->where('inhouse', false)
                ->where('date', '>', today())
                ->orderBy('date')
                ->get(), 50
        );

        return view('list', compact('courses', 'type'));
    }

    public function bespoke(CourseType $type = null)
    {
        return view('bespoke', compact('type'));
    }

    public function blogpost(BlogPost $blogpost)
    {
        $courses = Cache::remember('courses', 900, function () {
            return $this->filterOutSomeFullyBookedCourses(
                Course::query()
                    ->with(['venue', 'course_type'])
                    ->where('course_type_id', 1)
                    ->where('inhouse', false)
                    ->where('date', '>', today())
                    ->orderBy('date')
                    ->get(), 10
            );
        });

        return view('blog', compact('blogpost', 'courses'));
    }

    public function venue(Venue $venue)
    {
        $courses = $this->filterOutSomeFullyBookedCourses(
            Course::query()
                ->where('venue_id', $venue->id)
                ->with(['venue', 'course_type'])
                ->where('inhouse', false)
                ->where('date', '>', today())
                ->orderBy('date')
                ->get(), 10
        );

        $image = Cache::remember('image'.$venue->slug, 3600, function () {
            return Arr::random($this->cloudinary_resources('pictures', 50, 'cloudinary_optimised_jpg'));
        });

        return view('venue', compact('venue', 'courses'));
    }

    /**
     * @return array
     *
     * @throws Api\GeneralError
     */
    private function cloudinary_resources(string $path, int $take, string $preset)
    {
        \Cloudinary::config([
            'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
            'api_key' => env('CLOUDINARY_API_KEY'),
            'api_secret' => env('CLOUDINARY_API_SECRET'),
            'secure' => true,
        ]);

        $c = new Api();

        $response = $c->resources(
            [
                'type' => 'upload',
                'prefix' => 'cit/'.$path,
                'max_results' => $take,
            ]
        );

        $items = [];

        foreach ($response['resources'] as $resource) {
            $url = Str::after(Str::beforeLast($resource['secure_url'], '.'), 'cit');
            $url = Str::replaceFirst('e_bgremoval', 'e_bgremoval', Cloudder::secureShow('cit/'.$url, config('settings.'.$preset)));
            array_push($items, $url);
        }

        if ($path !== 'logos') {
            $course_types = CourseTypeGroup::all();

            foreach ($course_types as $course_type) {
                if ($course_type->icon) {
                    array_push($items, Str::beforeLast(Cloudder::secureShow(''.$course_type->icon, config('settings.'.$preset)), '.'));
                }
            }
        }

        return $items;
    }

    public function filterOutSomeFullyBookedCourses($c, $take)
    {
        $fully_booked = $c->filter(function ($item) {
            return $item->placesLeft() <= 0;
        });

        $fullyBookedSubset = $fully_booked->nth(7)->take(-3);

        $stillAvailableSubset = $c->filter(function ($item) {
            return $item->placesLeft() > 0;
        });

        return $fullyBookedSubset->merge($stillAvailableSubset)->take($take);
    }
}
