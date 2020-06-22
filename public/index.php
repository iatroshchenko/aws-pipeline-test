<?php
error_reporting(E_ALL);

/* functions */
function dump($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

function d($var)
{
    return dump($var);
}

function isArrayKey($array, $key, $val, int $strict = 0): bool
{
    if ($strict) {
        if (isset($array[$key]) && $array[$key] === $val) {
            return true;
        } else {
            return false;
        }
    } else {
        if (isset($array[$key]) && $array[$key] == $val) {
            return true;
        } else {
            return false;
        }
    }
}

function isStrictArrayKey($array, $key, $value): bool
{
    return isArrayKey($array, $key, $value, 1);
}

function is($var, $val, int $strict = 0): bool
{
    if ($strict) {
        if (isset($var) && $var === $val) {
            return true;
        } else {
            return false;
        }
    } else {
        if (isset($var) && $var == $val) {
            return true;
        } else {
            return false;
        }
    }
}

function isStrict($var, $val): bool
{   
    return is($var, $val, 1);
}

function direct($requestURI, $router)
{
    $requestURI = trim($requestURI, '/');
    if (!$requestURI) {
        $requestURI = '/';
    }

    return array_key_exists($requestURI, $router) ?
        $router[$requestURI]() : $router['404']();
}
/* functions end */


const PATH_MAIN = '/';
const PATH_BACKEND = 'backend';
const PATH_404 = '404';

function common () {
    if (!isset($_SESSION['count']) || isArrayKey($_POST, 'refresh', 1)) $_SESSION['count'] = 0;
    $_SESSION['count']+= 1;
    echo "<h1>You were here {$_SESSION['count']} times!</h1>";
    require_once('template.php');
}

$router = [
    PATH_MAIN => function () {
        echo '<h1>Main Page</h1>';
        common();
    },
    PATH_BACKEND => function () {
        echo '<h1>Backend Page</h1>';
        common();
    },
    PATH_404 => function () {
        echo '<h1>404. Not found</h1>';
        // common();
    }
];

$requestURI = $_SERVER['REQUEST_URI'];
session_start();

return direct($requestURI, $router);