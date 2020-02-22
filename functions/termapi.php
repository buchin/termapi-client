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

    $token = TermApi::token(termapi_home_url());

    file_put_contents($path, $token);

    return $token;
}

function token_filename()
{
    // refresh token each day
    return md5(termapi_home_url() . date('Y-m-d')) . '.txt';
}

function termapi_home_url()
{
    $home_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'];
    return $home_url;
}