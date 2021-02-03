<?php

return [
    /*
     * This is the class responsible for providing the URLs which must be redirected.
     * The only requirement for the redirector is that it needs to implement the
     * `Spatie\MissingPageRedirector\Redirector\Redirector`-interface
     */
    'redirector' => \Spatie\MissingPageRedirector\Redirector\ConfigurationRedirector::class,

    /*
     * By default the package will only redirect 404s. If you want to redirect on other
     * response codes, just add them to the array. Leave the array empty to redirect
     * always no matter what the response code.
     */
    'redirect_status_codes' => [
        \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND,
    ],

    /*
     * When using the `ConfigurationRedirector` you can specify the redirects in this array.
     * You can use Laravel's route parameters here.
     */
    'redirects' => [
        '/contact-us/' => '/bespoke_solution/10',
        '/solas-safe-pass/' => '/list/1/solas-safe-pass',
        '/locations/parslickstown-house-4/' => '/',
        '/locations/cit-ltd/' => '/',
        '/locations/cit-training-room-8/' => '/',
        '/locations/cit-training-room-10/' => '/',
        '/locations/cit-training-room-12/' => '/',
        '/locations/cit-training-room-13/' => '/',
        '/locations/dunboyne-castle-hotel/' => '/',
        '/events/location-of-underground-services/' => '/',
        '/events/categories/qqi/' => '/',
        '/events/ladder-safety/' => '/',
        '/events/forklift/' => '/',
        '/events/power-pallet-truck/' => '/',
        '/events/chemical-awareness/' => '/',
        '/events/spill-kit/' => '/',
        '/events/temporary-works/' => '/',
        '/events/lock-out-tag-out/' => '/',
        '/events/confined-spaces-search-rescue/' => '/group/7/confined-spaces',
        '/events/working-at-heights/' => '/group/2/working-at-heights',
        '/events/vehicle-banksman/' => 'https://cit.test/group/10/plant-and-machinery',
        '/events/emergency-first-aid/' => 'https://cit.test/group/5/first-aid',
        '/events/firewarden/' => 'https://cit.test/group/11/other-courses',
        '/events/confined-spaces-management/' => 'https://cit.test/group/7/confined-spaces',
        '/events/confined-spaces-medium-risk/' => 'https://cit.test/group/7/confined-spaces',
        '/events/abrasive-wheels/' => 'https://cit.test/group/6/abrasive-wheels',
        '/events/confined-spaces-high-risk/' => 'https://cit.test/group/7/confined-spaces',
        '/events/occupational-first-aid/' => 'https://cit.test/group/5/first-aid',
        '/events/wewp/' => 'https://cit.test/group/1/mewp',
        '/events/patient-handling-instructor/' => 'https://cit.test/group/5/first-aid',
        '/events/safe-use-of-harnesses/' => 'https://cit.test/group/2/working-at-heights',
        '/events/confined-spaces-low-risk/' => 'https://cit.test/group/7/confined-spaces',
        '/events/training-delivery-and-evaluation-train-the-trainer/' => 'https://cit.test/group/12/instructor-courses',
        '/events/patientpeople-handling/' => 'https://cit.test/group/5/first-aid',
        '/events/ride-on-roller/' => 'https://cit.test/group/10/plant-and-machinery',
        '/events/cscs-mobile-access-tower-scaffold/' => 'https://cit.test/group/1/mewp',
        '/events/cscs-360-degree-excavator/' => 'https://cit.test/group/10/plant-and-machinery',
        '/events/cscs-180-degree-excavator/' => 'https://cit.test/group/10/plant-and-machinery',
        '/events/cscs-slinger-signaller/' => 'https://cit.test/group/10/plant-and-machinery',
        '/events/cscs-site-dumper/' => 'https://cit.test/group/10/plant-and-machinery',
        '/events/cscs-teleporter/' => 'https://cit.test/group/10/plant-and-machinery',
        '/events/solas-safe-pass-old/' => 'https://cit.test/list/1/solas-safe-pass',
    ],

];
