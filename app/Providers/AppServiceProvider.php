<?php

namespace App\Providers;

use App\Category;
use App\Event;
use App\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.partial._header',function ($view){
            return $view->with(['categories'=>Category::where('status','1')->orderBy('name')->get(), 'logo'=>Setting::select('logo')->first()]);
        });

        View::composer('frontend.partial._footer',function ($view){
            return $view->with(['settings'=>Setting::select('short_desc', 'phone', 'email', 'address', 'facebook_url',
                'youtube_url', 'twitter_url', 'google_plus_url', 'platform_name', 'developer_name', 'developer_link', 'logo')->first(), 'events'=>Event::where('status', '1')->select('id','title', 'img')->limit(3)->get()]);
        });

        View::composer('frontend.partial._header_link',function ($view){
            return $view->with(['icon'=>Setting::select('favicon')->first()]);
        });

        /*View::composer(['admin.partial._topbar','frontend.partial._banner','password.master'],function ($view){
            return $view->with(['logo'=>Setting::first()->logo]);
        });

        View::composer('frontend.partial._header',function ($view){
            return $view->with(['categories'=>Category::where('status','1')->orderBy('name')->get(), 'abouts'=>About::first(),'socials'=>Social::first()]);
        });

        View::composer(['admin.partial._header', 'frontend.partial._header','password.master'],function ($view){
            return $view->with(['favicon'=>Setting::first()->favicon]);
        });

        View::composer('frontend.page.partial._photo_gallery', function ($view) {
            return $view->with(['images'=>Image::where('status','1')->orderBy('id')->limit(4)->get()]);
        });

        View::composer('frontend.page.partial._popular', function ($view) {
            return $view->with(['popular'=>Post::where('status','1')->orderBy('total_view','desc')->limit(3)->get()]);
        });

        View::composer('frontend.page.partial._recent_post', function ($view) {
            return $view->with(['posts'=>Post::where('status','1')->orderBy('id')->limit(10)->get()]);
        });

        View::composer('frontend.page.partial._social_media', function ($view) {
            return $view->with(['follower'=>Follower::first()]);
        });*/
    }
}
