<?php

describe('popular_terms()', function ()
{
	it('get popular terms from Term API', function(){
		expect(popular_terms([
			'token' => '14b356d30646abf3bcaa08160633c55b'
		]))->toBeA('array');
	});
});