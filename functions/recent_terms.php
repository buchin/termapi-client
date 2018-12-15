<?php
use Buchin\TermapiClient\TermApi;

function recent_terms($options = [])
{
	$api = new TermApi($options['token']);
	return $api->recent($options)->data;
}