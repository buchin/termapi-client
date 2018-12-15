<?php 
namespace Buchin\TermapiClient;

class TermApi
{
	private $token = '';
	private $url = 'https://termapi.dojo.cc/api';
	
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
}