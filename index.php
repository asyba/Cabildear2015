<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
session_start();
require 'Slim/Slim.php';
require 'config/database.php';
require 'config/general.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();
$app->contentType('text/html; charset=utf-8');
/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

// GET route
$app->get(
    '/',
    function () {
        require_once('template/head.tpl.php');
        require_once('template/index.tpl.php');
        require_once('template/foot.tpl.php');
        
    }
);

// GET route
$app->get(
    '/form',
    function () {
        require_once('template/head.tpl.php');
        require_once('template/form.tpl.php');
        require_once('template/foot.tpl.php');
    }
);

// GET route
$app->get(
    '/legislador/:legislador',
    function ($legislador) {
        require_once('template/head.tpl.php');
        require_once('template/legislador.tpl.php');
        require_once('template/foot.tpl.php');
    }
);

// POST route
$app->post(
    '/post',
    function () {
        echo 'This is a POST route';
    }
);

$app->get (
    '/login',
    function () {
    }
);
$app->post (
    '/login',
    function () {
        $salt = 'LB2SvJAtfwrEYqykb9x5qvNh';
    }
);

$app->get (
    '/login/twitter',
    function () use ($app) {
        require_once('includes/twitteroauth/twitteroauth.php');
        
        if(isset($_SESSION['name']) && isset($_SESSION['twitter_id'])) { //check whether user already logged in with twitter
            echo "Name :".$_SESSION['name']."<br>";
            echo "Twitter ID :".$_SESSION['twitter_id']."<br>";
            echo "Image :<img src='".$_SESSION['image']."'/><br>";
            echo "<br/><a href='". getURL('/logout') . "'>Logout</a>";
        } else { // Not logged in
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
            $request_token = $connection->getRequestToken(OAUTH_CALLBACK); //get Request Token

            if(	$request_token) {
                $token = $request_token['oauth_token'];
                $_SESSION['request_token'] = $token ;
                $_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
                
                switch ($connection->http_code) {
                    case 200:
                        $url = $connection->getAuthorizeURL($token);
                        //echo $url;exit;
                        //redirect to Twitter .
                        $app->redirect($url);
                        break;
                    default:
                        echo "Coonection with twitter Failed";
                        break;
                }
            } else {  //error receiving request token
                echo "Error Receiving Request Token";
            }
        }
    }
);

$app->get(
    '/logout',
    function () use ($app) {
        session_destroy();
        $app->redirect('/');
    }
);

// PUT route
$app->put(
    '/put',
    function () {
        echo 'This is a PUT route';
    }
);

// PATCH route
$app->patch('/patch', function () {
    echo 'This is a PATCH route';
});

// DELETE route
$app->delete(
    '/delete',
    function () {
        echo 'This is a DELETE route';
    }
);

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
