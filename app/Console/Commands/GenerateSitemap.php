<?php

namespace App\Console\Commands;

use App\BlogPost;
use App\Course;
use App\CourseTypeGroup;
use App\Models\Recepcja\Doctor;
use App\Models\Recepcja\DoctorGroup;
use App\Venue;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto generates sitemap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $sitemap = Sitemap::create();

        $sitemap ->add(Url::create(url('/'))
            ->setPriority(1)
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        $sitemap ->add(Url::create(url(route('list')))
            ->setPriority(0.9)
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        Course::where('course_type_id', 1)->where('inhouse', false)->where('date', '>=', today())->orderBy('date')->each(function (Course $course) use ($sitemap){
            $sitemap ->add(Url::create(url(route('create-booking', ['course' => $course->slug])))
                ->setPriority(0.9)
                ->setLastModificationDate(Carbon::today())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));
        });

        CourseTypeGroup::where('id', '<>', 14)->each(function (CourseTypeGroup $group) use ($sitemap){
            $sitemap ->add(Url::create(url(route('group', ['group' => $group->slug])))
                ->setPriority(0.8)
                ->setLastModificationDate(Carbon::today())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
        });

        BlogPost::where('header', '<>', 'LEGAL')->each(function (BlogPost $blogpost) use ($sitemap){
            $sitemap ->add(Url::create(url(route('blog', ['blogpost' => $blogpost->slug])))
                ->setPriority(0.7)
                ->setLastModificationDate(Carbon::today())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
        });

        Venue::whereNotNull(['city','postal_code','photo','google_maps', 'description'])->each(function (Venue $venue) use ($sitemap){
            $sitemap ->add(Url::create(url(route('venue', ['venue' => $venue->slug])))
                ->setPriority(0.6)
                ->setLastModificationDate(Carbon::today())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
        });

        $sitemap ->add(Url::create(url(route('bespoke')))
            ->setPriority(0.6)
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
