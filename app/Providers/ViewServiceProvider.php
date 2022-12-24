<?php

namespace App\Providers;

use App\Models\DocumentType;
use App\Models\GroupMenus;
use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Province;
use App\Models\Sex;
use App\Models\UserHasMenu;
use App\Models\UserTypeURL;
use Illuminate\Support\Facades\DB;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        # COMPOSE MENU
        View::composer(['layouts.sidebar', 'layouts.breadcrumb', 'users.edit'],function ($view) {

            $userType = auth()->user()->user_type_id;
            $urls = UserTypeURL::where('user_type_id', $userType)->get(['url_id']);
            // dd($urls->toArray());

            $urlArr = [];
            foreach($urls as $url){
                $urlArr[] = $url->url_id;
            }

            $groups = GroupMenus::with([
                'menus' => function ($query) use($urlArr) {
                    $query->whereIn('url_id',$urlArr);
                    return $query->orWhereIn('id', function($query) use( $urlArr){
                    $query->select('parent_id')
                    ->from(with(new Menu())->getTable())
                    ->whereIn('url_id',  $urlArr);});
                },
                'menus.childs' => function ($query) use($urlArr) {
                    $query->whereIn('url_id',$urlArr);
                },
            ])->get();

            $view->with(['groups' => $groups]);
        });

        View::composer(['includes.create-client', 'master-data.staffs.create'],function ($view) {
            $view->with([
                'provinces' => Province::whereActive(true)->get(),
                'sexes' => Sex::all(),
                'documents' => DocumentType::all()
            ]);
        });
    }
}
