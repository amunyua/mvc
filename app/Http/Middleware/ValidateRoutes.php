<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Route;
use App\Route as RouteItem;

class ValidateRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() === null){
            return view('pages.access_denied');
        }

        // get current route
        $route_name = Route::getFacadeRoot()->current()->uri();

        // get logged in user
        $user = $request->user();

        // get current route data
        $route = RouteItem::where('url', $route_name)->first();

        // get all roles for the route
        $roles = RouteItem::find($route->id)->roles()->get();

        $user_roles = [];
        foreach ($roles as $role){
            $user_roles[] = $role->id;
        }

//        var_dump($request->user()->hasAnyRole($user_roles));exit;
        if($request->user()->hasAnyRole($user_roles)){
            return $next($request);
        }else{
//            var_dump('Access Denied');exit;
            return redirect('/access-denied');
//            return Response::json([
//                'status' => 'Access Denied'
//            ]);
        }
    }
}
