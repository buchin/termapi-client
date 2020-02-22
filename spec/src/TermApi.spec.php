<?php
use Buchin\TermapiClient\TermApi;

fdescribe('TermApi::nerd($token)', function ()
{
	it('Get redirect link from termapi server', function(){
		expect(TermApi::nerd('b125494519869822eafca06bdea5ec35', 'cli'))->toBeA('string');
	});
});