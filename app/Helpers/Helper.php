<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Authorization\AuthorizationChecker;

if(!function_exists('bdDate')){
    function bdDate($date){
        return Carbon::parse($date)->format('d/m/Y');
    }
}

if(!function_exists('ageWithDays')){
    function ageWithDays($d_o_b){
        return Carbon::parse($d_o_b)->diff(Carbon::now())->format('%y years, %m months and %d days');
    }
}
if(!function_exists('ageWithMonths')){
    function ageWithMonths($d_o_b){
        return Carbon::parse($d_o_b)->diff(Carbon::now())->format('%y years, %m months');
    }
}

if (!function_exists('imageStore')) {
    function imageStore(Request $request, $requestName, string $name, string $path)
    {
        if($request->hasFile($requestName)){
            $pathCreate = public_path().$path;
            !file_exists($pathCreate) ?? File::makeDirectory($pathCreate, 0777, true, true);

            $image = $request->file($requestName);
            $image_name = $name . uniqueId(10).'.'.$image->getClientOriginalExtension();
            if ($image->isValid()) {
                $request->$requestName->move($path,$image_name);
                return $image_name;
            }
        }
    }
}

if (!function_exists('imageUpdate')) {
    function imageUpdate(Request $request, $request_name ,string $name, string $path, $image)
    {
        if($request->hasFile($request_name)){
            $deletePath =  public_path($path.$image);
            if(file_exists($deletePath) && $image != ''){
                unlink($deletePath);
            }
            // file_exists($deletePath) ? unlink($deletePath) : false;
            $createPath = public_path().$path;
            !file_exists($createPath) ?? File::makeDirectory($createPath, 0777, true, true);

            $image = $request->file($request_name);
            $image_name = $name . uniqueId(20).'.'.$image->getClientOriginalExtension();
            if ($image->isValid()) {
                $request->image->move($path,$image_name);
                return $image_name;
            }
        }
    }
}

if(!function_exists('profileImg')){
    function profileImg(){
        if(file_exists(asset('uploads/images/user/'.user()->image))){
            return asset('uploads/images/user/'.user()->image);
        }else{
            return asset('uploads/images/user/profile_blank.png');
        }
    }
}


if (!function_exists('imagePath')) {
    function imagePath($folder, $image)
    {
        $path = 'uploads/images/'.$folder.'/'.$image;
        if(@GetImageSize($path)){
            return asset($path);
        }else{
            // return setting('app_logo');
        }
    }
}

if (!function_exists('activeSubNav')) {
    function activeSubNav($route)
    {
        if (is_array($route)) {
            $rt = '';
            foreach ($route as $rut) {
                $rt .= request()->routeIs($rut) || '';
            }
            return $rt ? ' mm-active ' : '';
        }
        return request()->routeIs($route) ? ' mm-active ' : '';
    }
}

if (!function_exists('activeNav')) {
    function activeNav($route)
    {
        if (is_array($route)) {
            $rt = '';
            foreach ($route as $rut) {
                $rt .= request()->routeIs($rut) || '';
            }
            return $rt ? ' mm-active ' : '';
        }
        return request()->routeIs($route) ? ' mm-active ' : '';
    }
}

if (!function_exists('openNav')) {
    function openNav(array $routes)
    {
        $rt = '';
        foreach ($routes as $route) {
            $rt .= request()->routeIs($route) || '';
        }
        return $rt ? ' mm-collapse mm-show ' : '';
    }
}

if (!function_exists('uniqueId')) {
    function uniqueId($lenght = 8)
    {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }
}

if (!function_exists('transaction_id')) {
    function transaction_id($src = '', $length = 12)
    {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($length / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        if ($src != '') {
            return strtoupper($src.'_'.substr(bin2hex($bytes), 0, $length));
        }
        return strtoupper(substr(bin2hex($bytes), 0, $length));
    }
}

if (!function_exists('user')) {
    function user()
    {
        return auth()->user();
    }
}


