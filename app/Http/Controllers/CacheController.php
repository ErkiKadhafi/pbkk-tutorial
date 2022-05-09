<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheController extends Controller
{
    public function getAllCacheKeys()
    {
        $data = DB::table('cache')->get();
        foreach($data as $cache){
            $time = Carbon::parse($cache->expiration);
            $key = trim(str_replace('laravel_cache', '', $cache->key));
            
            if($time->isPast()){
                // dump($cache);
                Cache::forget($key);
                $data->forget($cache);
            }
        }
        return view('home', ['allCacheData' => $data]);
    }
    public function addNewKey(Request $request)
    {
        // dd($request->expiration);
        $time = is_null($request->expiration) ? 60 : $request->expiration;
        // dd(Carbon::now()->addSeconds($time)->format('l, j F Y ; h:i a'));
        Cache::put($request->key, $request->cache_value, Carbon::now()->addSeconds($time));
        return redirect()->route("cache/index");
    }
    public function deleteKey(Request $request)
    {
        // dd($request->key);
        $key = trim(str_replace('laravel_cache', '', $request->key));
        Cache::forget($key);
        return redirect()->route("cache/index");
    }
    public function deleteAll()
    {
        Cache::flush();
        return redirect()->route("cache/index");
    }
    public function pullKey(Request $request)
    {
        $key = trim(str_replace('laravel_cache', '', $request->key));
        $value = Cache::pull($key);
        // dd($value);
        return redirect()->route("cache/index")->with('dataPulled', $value);
    }
}
