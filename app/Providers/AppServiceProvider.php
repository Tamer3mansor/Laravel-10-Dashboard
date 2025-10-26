<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Event;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
  public function boot(): void
{
    // هنا نستخدم الحدث الذي ينفذه AdminLTE لبناء القائمة
    Event::listen(BuildingMenu::class, function (BuildingMenu $event) {

        // يمكنك الآن استخدام route() و __('...') بأمان
     
        $event->menu->add(        [
        'text' => 'Language',
        'icon' => 'fas fa-globe',
        'submenu' => collect(LaravelLocalization::getSupportedLocales())
            ->map(function ($properties, $locale) {
                return [
                    'text' => $properties['native'],
                    'url'  => LaravelLocalization::getLocalizedURL($locale, null, [], true),
                ];
            })
            ->values()
            ->toArray(),
        ],
            [

        'text' => __('auth.Roles And Permissions'),
    'icon' => 'fas fa-fw fa-user-shield',
    'submenu' => [
        [
            'text' => __('auth.Manage Roles'),
            'icon' => 'fas fa-fw fa-user-tag',
            'route' => 'admin.roles.index',
        ],
 
        [
            'text' => __('auth.Manage Admins'),
            'icon' => 'fas fa-fw fa-users-cog',
            'route' => 'admin.admins.index',
        ],

    ]
        ],   
        

);
        
        // أضف هنا أي عناصر قائمة أخرى تحتاج إلى route() أو ترجمة
    });
}
}
