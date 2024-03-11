<?php

function redirect($url, $query = [])
{
    $url = trim($url, '/ ');
    $url = strpos($url, URLROOT) === 0 ? URLROOT . '/' . $url : $url;
    $url = url($url, $query);
    header("Location: " . $url);
    exit;
}

function back()
{
    $http_referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
    redirect($http_referer);
}

function backUrl()
{
    return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;

}

function asset($src)
{
    return URLROOT . 'public/' . trim($src, "/ ");
}

function url($url, $query = [])
{
    if (!count($query)) {
        return URLROOT . (trim($url, "/ "));
    }
    return URLROOT . $url . '?' . http_build_query($query);
}

//Load views
function view($src)
{
    $newSrc = trim($src, "/ ");
    require_once(APPROOT . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $newSrc . ".php");
}

// Create a URL for a view
function url_view_builder($src)
{
    $newSrc = trim($src, "/ ");
    return URLROOT . $newSrc;
}


function active_header($rout)
{
    $queryString = $_SERVER['REDIRECT_URL'];
    $urlParam = '/venus-blog-project/public/';
    if (empty($queryString)) {
        $urlParam = '';
    }

    if (substr($queryString, 0, strlen($urlParam)) === $urlParam) {

        $queryString = substr($queryString, strlen($urlParam));
        return (isset($rout) && $queryString == $rout) ? 'active' : '';
    }
}

// function active_header($rout)
// {
//     $queryString = $_SERVER['QUERY_STRING'];
//     $urlParam = 'url=';
//     if (empty($queryString)) {
//         $urlParam = '';
//     }

//     if (substr($queryString, 0, strlen($urlParam)) === $urlParam) {

//         $queryString = substr($queryString, strlen($urlParam));
//         return (isset($rout) && $queryString == $rout) ? 'active' : '';
//     }
// }
