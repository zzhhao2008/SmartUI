<?php
$routerMap=[];
class Router{
    static public function getUri(){
        $uri=$_SERVER['REQUEST_URI'];
        if($uri==='/'||$uri[1]==='?') return '/';
        $uri=addslashes($uri);
        $qp=stripos($uri,"?")-1;
        if($qp<=0) $qp=strlen($uri)-1;
        $uri=substr($uri,1,$qp);
        return $uri;
    }
    static public function any($uri,$scp){
        global $routerMap;
        $routerMap['any'][$uri]=$scp;
    }

    static public function post($uri,$scp){
        global $routerMap;
        $routerMap['post'][$uri]=$scp;
    }
    static public function loadRouteMap(){
        global $routerMap;
        include includeC("route");
        return;
    }
    static public function GetScriptPath($ru,$userpower=0){
        global $routerMap;
        if(empty($routerMap)) Router::loadRouteMap();
        if(isset($routerMap['any'][$ru])) return $routerMap['any'][$ru];
        return "error/404";
    }
}