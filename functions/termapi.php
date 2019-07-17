<?php
use Buchin\TermapiClient\TermApi;

function termapi($token = null)
{
    $token = (is_null($token)) ? get_token() : $token;
	return TermApi::termapi($token);
}

function get_token()
{
    $path = __DIR__ . '/tokens_' . token_filename();
    if(file_exists($path)){
        return file_get_contents($path);
    }

    $token = TermApi::token(home_url());

    file_put_contents($path, $token);

    return $token;
}

function token_filename()
{
    return md5(home_url()) . '.txt';
}

if(!function_exists('home_url')){
    function home_url()
    {
        $home_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'];
        return $home_url;
    }
}