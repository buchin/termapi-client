<?php
use Buchin\TermapiClient\TermApi;

function termapi($token = null)
{
    $token = (is_null($token)) ? termapi_get_token() : $token;
	return TermApi::termapi($token);
}

function termapi_get_token()
{
    $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'tokens_' . termapi_token_filename();

    $token = trim(@file_get_contents($path));

    if(!empty($token)){
        return $token;
    }

    $token = TermApi::token(termapi_home_url());

    file_put_contents($path, $token);

    return $token;
}

function termapi_token_filename()
{
    // refresh token each day
    return md5(termapi_home_url() . date('Y-m-d')) . '.txt';
}

function termapi_home_url()
{
    $home_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'];
    return $home_url;
}
