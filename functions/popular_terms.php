<?php
use Buchin\TermapiClient\TermApi;

function popular_terms($options = [])
{
	$api = new TermApi($options['token']);
	return $api->popular($options);
}