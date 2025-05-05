<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Room;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

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
        // Set pagination to use Bootstrap
        Paginator::useBootstrap(); 

        View::composer('partials.recommendations', function ($view) {
            $user = Auth::user();
    
            if ($user) {
                $userReviews = Review::where('user_id', $user->id)
                    ->where('rating', '>=', 4)
                    ->pluck('room_id');
    
                $recommendedRooms = $userReviews->isEmpty() 
                    ? Room::inRandomOrder()->limit(3)->get()
                    : Room::whereIn('room_type', function ($query) use ($userReviews) {
                        $query->select('room_type')
                            ->from('rooms')
                            ->whereIn('id', $userReviews);
                    })->whereNotIn('id', $userReviews)->limit(3)->get();
    
                $view->with('recommendedRooms', $recommendedRooms);
            } else {
                $view->with('recommendedRooms', collect());
            }
        });
    }
}
