<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/27/2018
 * Time: 4:11 PM
 */

if (!function_exists('jsRedirect')) {
    function jsRedirect($url)
    {
        $redirect_call =
            'try{ _paq; _paq.push([function() { top.location="' . $url . '"; }]);}
            catch(e) {
                if(e.name == "ReferenceError") {
                    top.location="' . $url . '";
                }
            }';
        $head_script = \Illuminate\Support\Facades\View::make('afw::head_script', ['redirectCall' => $redirect_call])->render();
        echo "<!DOCTYPE html>
            <html lang=\"en\">
              <head>
              </head>
              <body>
              " . $head_script . "
              </body>
            </html><!--";
        Illuminate\Support\Facades\Session::save();
        exit;
    }
}


if (!function_exists('get_query_string')) {
    function get_query_string($array)
    {
        $query = "?app_data=";
        foreach ($array as $key => $item) {
            $query .= $key . "=" . urlencode($item) . "|";
        }
        return $query;
    }
}


if (!function_exists('getCurrentCycleId')){
    function getCurrentCycleId(){
        if($cycleId = App\Http\SessionHandler::get('cycleId')){
            return $cycleId;
        }
        $query = \Illuminate\Support\Facades\DB::select(\Illuminate\Support\Facades\DB::raw('SELECT id as cycleId FROM cycles WHERE CURRENT_TIMESTAMP < lasts_until ORDER BY lasts_until asc LIMIT 1'));
        if(isset($query[0])) {
            $cycleId = $query[0]->cycleId;
            App\Http\SessionHandler::set('cycleId', $cycleId);
            return $cycleId;
        }
        return -1;
    }
}

if( !function_exists('afw_gallery_url')){
    function afw_gallery_url($file){
        return url(afw_service_config('gallery.relativeUploadsPath') . $file);
    }
}

if( !function_exists('afw_service_name')){
    function afw_service_name(){
        try{
            return resolve('afwServiceName');
        } catch (ReflectionException $e){
            return null;
        }
    }
}

if( !function_exists('afw_service_namespace')){
    function afw_service_namespace(){
        $serviceName = afw_service_name();
        if($serviceName){
            return $serviceName . '.afw';
        } else {
            return '';
        }
    }
}

if( !function_exists('afw_service_config')){
    function afw_service_config($key, $default = null){

        return config(afw_service_namespace() . '.' . $key, $default);
    }
}

if (!function_exists('afw_service_type')){
    function afw_service_type(){
        try{
            $afwServiceName = afw_service_name();
            if($afwServiceName) {
                $afwService = resolve($afwServiceName);
                return $afwService->getServiceType();
            }
            return null;
        } catch (ReflectionException $e){
            return null;
        }
    }
}


if(!function_exists('afw_view')){
    function afw_view($view){
        return view(afw_service_namespace() . '::' . $view);
    }
}
