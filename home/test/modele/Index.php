<?php
require_once("lib/Google/Auth/FetchAuthTokenInterface.php");
require_once("lib/Psr/Http/Message/UriInterface.php");
require_once("lib/GuzzleHttp/Psr7/Uri.php");
require_once("lib/Psr/Http/Message/StreamInterface.php");
require_once("lib/GuzzleHttp/Psr7/Stream.php");
require_once("lib/GuzzleHttp/Psr7/functions.php");
require_once("lib/GuzzleHttp/Psr7/MessageTrait.php");
require_once("lib/Psr/Http/Message/MessageInterface.php");
require_once("lib/Psr/Http/Message/RequestInterface.php");
require_once("lib/GuzzleHttp/Psr7/Request.php");
require_once("lib/Google/Auth/OAuth2.php");
require_once("lib/Google/Auth/HttpHandler/Guzzle6HttpHandler.php");
require_once("lib/Google/Auth/HttpHandler/HttpHandlerFactory.php");
require_once("lib/GuzzleHttp/ClientInterface.php");
require_once("lib/GuzzleHttp/Handler/Proxy.php");
require_once("lib/GuzzleHttp/Handler/CurlFactoryInterface.php");
require_once("lib/Psr/Http/Message/ResponseInterface.php");
require_once("lib/GuzzleHttp/Psr7/Response.php");
require_once("lib/GuzzleHttp/Handler/EasyHandle.php");
require_once("lib/GuzzleHttp/Promise/PromiseInterface.php");
require_once("lib/GuzzleHttp/Promise/Promise.php");
require_once("lib/GuzzleHttp/Promise/FulfilledPromise.php");
require_once("lib/GuzzleHttp/Handler/CurlFactory.php");
require_once("lib/GuzzleHttp/Handler/CurlMultiHandler.php");
require_once("lib/GuzzleHttp/Handler/CurlHandler.php");
require_once("lib/GuzzleHttp/Handler/StreamHandler.php");
require_once("lib/GuzzleHttp/functions.php");
require_once("lib/GuzzleHttp/PrepareBodyMiddleware.php");
require_once("lib/GuzzleHttp/Middleware.php");
require_once("lib/GuzzleHttp/HandlerStack.php");
require_once("lib/GuzzleHttp/RedirectMiddleware.php");
require_once("lib/GuzzleHttp/RequestOptions.php");
require_once("lib/GuzzleHttp/Psr7/UriResolver.php");
require_once("lib/GuzzleHttp/Promise/functions.php");
require_once("lib/GuzzleHttp/Promise/TaskQueueInterface.php");
require_once("lib/GuzzleHttp/Promise/TaskQueue.php");
require_once("lib/GuzzleHttp/Client.php");
require_once("lib/Google/Client.php");


class Home_Test_Modele_Index extends Core_Modele_Abstract {
    public function getContent() {
        $ret = array();
        
        /*$client = new Google_Client();
        
        $client->setApplicationName("corentinlebail.me");
        $client->setAuthConfig(Core_Clbfw::getBaseDirname()."/data/credentials/client_credentials.json");
        $client->addScope("https://www.googleapis.com/auth/userinfo.email");
        $ret = $client->fetchAccessTokenWithAuthCode("corentin.lebail@gmail.com");*/
        
        return $ret;
    }
}