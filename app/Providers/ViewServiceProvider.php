<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\EthnicGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share ethnic groups with all views
        View::composer('*', function ($view) {
            try {
                if (DB::connection()->getDatabaseName()) {
                    if (Schema::hasTable('ethnic_groups')) {
                        $view->with('ethnicGroups', EthnicGroup::all());
                    }

                    if (Schema::hasTable('carts')) {
                        $carts = Auth::check()
                            ? Cart::where('user_id', Auth::id())->get()
                            : collect(); // empty collection for guests

                        $view->with('carts', $carts);
                    }
                }
            } catch (\Exception $e) {
                // Optional: log or ignore during setup
                Log::warning("Skipping view composer due to DB error: " . $e->getMessage());
            }
        });
    }

    public function register()
    {
        //
    }
}
