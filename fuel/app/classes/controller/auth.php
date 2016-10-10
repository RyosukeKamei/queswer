<?php
//require VENDORPATH."autoload.php";
require VENDORPATH."abraham/twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
define( 'OAUTH_CALLBACK', 'http://192.168.99.100/auth/callback/' );
//http://192.168.99.100/auth/callback/

//require('hybridauth/Hybrid/Auth.php');
//use hybridauth\Hybrid\Auth;
//define('BASE_URL', 'http://192.168.99.100/hybridauth/');

class Controller_Auth extends Controller
{
    private $_config = null;

    public function before()
    {
        if(!isset($this->_config))
        {
            $this->_config = Config::load('opauth', 'opauth');
        }
    }

    /**
     * eg. http://www.exemple.org/auth/login/facebook/ will call the facebook opauth strategy.
     * Check if $provider is a supported strategy.
     */
    public function action_login($_provider = null)
    {
        if(array_key_exists(Inflector::humanize($_provider), Arr::get($this->_config, 'Strategy')))
        {
        	if ($_provider === 'twitter')
        	{
        		/*
        		// HybridAuthの設定
        		$config = array(
        				'base_url' => BASE_URL,
        				'providers' => array(
        						'Twitter' => array(
        								'enabled' => true,
        								'keys' => array('key' => $this->_config["Strategy"]["Twitter"]["key"], 'secret' => $this->_config["Strategy"]["Twitter"]["secret"]),
        						)
        				)
        		);
        		
        		// 認証
        		$auth = new Hybrid_Auth($config);
        		$client = $auth->authenticate('Twitter');
        		*/
        		
        		//TwitterOAuthのインスタンスを生成し、Twitterからリクエストトークンを取得する
        		$connection = new TwitterOAuth($this->_config["Strategy"]["Twitter"]["key"], $this->_config["Strategy"]["Twitter"]["secret"]);
        		$request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => OAUTH_CALLBACK));
                try {
        		    $request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => OAUTH_CALLBACK));
        		} catch(Exception $e) {
        		    var_dump($e);
        		    exit;
        		}
        		//var_dump($request_token);
        		//exit;
        		
        		//リクエストトークンはcallback.phpでも利用するのでセッションに保存する
        		$_SESSION['oauth_token'] = $request_token['oauth_token'];
        		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        		
        		// Twitterの認証画面へリダイレクト
        		$url = $connection->url("oauth/authorize", array("oauth_token" => $request_token['oauth_token']));
        		header('Location: ' . $url);
        		exit;
        	}
        	// ユーザーを認証画面へ飛ばす
        	//header( 'Location: https://api.twitter.com/oauth/authorize?oauth_token=' . '747814861644529664-5qE0ayuLAR1GdH7dt7TTw8sSJy25yXQ') ;
        	//exit;
        	$_oauth = new Opauth($this->_config, true);
        	//\Auth_Opauth::forge();
        }
        
        else
        {
            return Response::forge('Strategy not supported');
        }
    }

    // Print the user credentials after the authentication. Use this information as you need. (Log in, registrer, ...)
    public function action_callback()
    {
        $_opauth = new Opauth($this->_config, false);

        switch($_opauth->env['callback_transport'])
        {
            case 'session':
                session_start();
                $response = $_SESSION['opauth'];
                unset($_SESSION['opauth']);
            break;            
        }
        
        $reason = null;
        if (array_key_exists('error', $response))
        {
            echo '<strong style="color: red;">Authentication error: </strong> Opauth returns error auth response.'."<br>\n";
        }
        
        else
        {
            if (empty($response['auth']) || empty($response['timestamp']) || empty($response['signature']) || empty($response['auth']['provider']) || empty($response['auth']['uid']))
            {
                echo '<strong style="color: red;">Invalid auth response: </strong>Missing key auth response components.'."<br>\n";
            }
            
            elseif (!$_opauth->validate(sha1(print_r($response['auth'], true)), $response['timestamp'], $response['signature'], $reason))
            {
                echo '<strong style="color: red;">Invalid auth response: </strong>'.$reason.".<br>\n";
            }
            
            else
            {
                echo '<strong style="color: green;">OK: </strong>Auth response is validated.'."<br>\n";

                /**
                 * It's all good. Go ahead with your application-specific authentication logic
                 */
            }
        }

        var_dump($_SESSION);
        return Response::forge(var_dump($response));
    }
}