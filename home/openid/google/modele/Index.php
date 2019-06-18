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
require_once("lib/Google/AuthHandler/Guzzle6AuthHandler.php");
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
require_once("lib/Psr/Log/LoggerInterface.php");
require_once("lib/Monolog/ResettableInterface.php");
require_once("lib/Monolog/Logger.php");
require_once("lib/Monolog/Handler/HandlerInterface.php");
require_once("lib/Monolog/Handler/AbstractHandler.php");
require_once("lib/Monolog/Handler/AbstractProcessingHandler.php");
require_once("lib/Psr/Cache/CacheItemPoolInterface.php");
require_once("lib/Psr/Cache/CacheItemInterface.php");
require_once("lib/Monolog/Handler/StreamHandler.php");
require_once("lib/Google/Auth/Cache/Item.php");
require_once("lib/Google/Auth/CacheTrait.php");
require_once("lib/Google/Auth/Middelware/ScopedAccessTokenMiddleware.php");
require_once("lib/Google/Auth/Cache/MemoryCacheItemPool.php");
require_once("lib/Google/AuthHandler/AuthHandlerFactory.php");
require_once("lib/Google/Exception.php");
require_once("lib/Google/Service/Exception.php");
require_once("lib/Google/Task/Runner.php");
require_once("lib/Google/Http/REST.php");
require_once("lib/Google/Client.php");

require_once("lib/Google/Model.php");
require_once("lib/Google/Collection.php");
require_once("lib/Google/Service.php");
require_once("lib/Google/Service/Resource.php");
require_once("lib/Google/Service/Plus/Resource/Comments.php");
require_once("lib/Google/Service/Plus/Resource/People.php");
require_once("lib/Google/Service/Plus/Resource/Activities.php");
require_once("lib/Google/Utils/UriTemplate.php");
require_once("lib/Google/Service/Plus/Person.php");
require_once("lib/Google/Service/Plus.php");

require_once("lib/Google/AccessToken/Revoke.php");


class Home_Openid_Google_Modele_Index extends Core_Modele_Abstract {
    const ACCESS_TOKEN = "access_token";   
    
    private static $googleClient = null;
    
    public static function getGoogleClient() {
        if(self::$googleClient == null) {
            self::$googleClient = new Google_Client();
            
            self::$googleClient->setApplicationName("corentinlebail.me");
            self::$googleClient->setAuthConfig(Core_Clbfw::getBaseDirname()."/data/credentials/client_credentials.json");
            self::$googleClient->addScope(array(
                "https://www.googleapis.com/auth/userinfo.email",
                "https://www.googleapis.com/auth/userinfo.profile",
                Google_Service_Plus::PLUS_ME,
            ));
        }
        
        return self::$googleClient;
    }
    
    public static function getImage() {
        if(Core_Session::getInstance()->hasData(Home_Openid_Google_Modele_Index::ACCESS_TOKEN)) {
            $accessToken = Core_Session::getInstance()->getData(Home_Openid_Google_Modele_Index::ACCESS_TOKEN);
            
            $client = self::getGoogleClient();
            $client->setAccessToken($accessToken);
            
            $me = self::getMe($client);
            
            $image = $me->getImage();
            
            return $image["url"];
        }
        
        return null;
    }
    
    public static function getEmail() {
        if(Core_Session::getInstance()->hasData(Home_Openid_Google_Modele_Index::ACCESS_TOKEN)) {
            $accessToken = Core_Session::getInstance()->getData(Home_Openid_Google_Modele_Index::ACCESS_TOKEN);
            
            $client = self::getGoogleClient();
            $client->setAccessToken($accessToken);
            
            $me = self::getMe($client);
            
            $email = $me->getEmails();
            
            return $email[0]["value"];
        }
        
        return null;
    }
    
    public static function getName() {
        if(Core_Session::getInstance()->hasData(Home_Openid_Google_Modele_Index::ACCESS_TOKEN)) {
            $accessToken = Core_Session::getInstance()->getData(Home_Openid_Google_Modele_Index::ACCESS_TOKEN);
            
            $client = self::getGoogleClient();
            $client->setAccessToken($accessToken);
            
            $me = self::getMe($client);
            
            return $me->getDisplayName();
        }
        
        return null;
    }
    
    private static function getMe($client) {
        $plus = new Google_Service_Plus($client);
        
        return $plus->people->get("me");
    }

    public function getContent() {
        $ret = array();
        
        $client = self::getGoogleClient();
        
        $client->setRedirectUri(Home_Openid_Google_Controller_Index::getUrl("index", "result", array(), true));
        
        $ret["auth_url"] = $client->createAuthUrl();
        
        return $ret;
    }
    
    public function authenticate($code) {
        $db = Core_Dbaccess::getInstance();
        
        $ret = array();
        
        $client = self::getGoogleClient();
        
        $client->fetchAccessTokenWithAuthCode($code);
        $accessToken = $client->getAccessToken();
        
        $me = self::getMe($client);
        $email = $me->getEmails();
        $image = $me->getImage();
        
        $sql = "
            INSERT INTO USER (email, name, avatar)
            VALUES (:email, :name, :avatar)
            ON DUPLICATE KEY UPDATE name=VALUES(name), avatar=VALUES(avatar)
        ";
        
        $stmt = $db->getPdo()->prepare($sql);
        
        $stmt->execute(array(
            ":email" => $email[0]["value"],
            ":name" => $me->getDisplayName(),
            ":avatar" => $image["url"],
        ));
        
        Core_Session::getInstance()->setData(Home_Openid_Google_Modele_Index::ACCESS_TOKEN, $accessToken);
        
        $ret["redirect_uri"] = Home_Controller_Index::getUrl();
        
        return $ret;
    }
}