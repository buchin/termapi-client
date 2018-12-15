<?php
use Buchin\TermapiClient\TermApi;

function insert_term($options = [])
{
	$api = new TermApi($options['token']);
	return $api->insert($options);
}