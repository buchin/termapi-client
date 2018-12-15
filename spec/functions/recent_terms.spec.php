<?php

describe('recent_terms()', function ()
{
	it('get recent terms from Term API', function(){
		expect(recent_terms([
			'token' => '14b356d30646abf3bcaa08160633c55b'
		]))->toBeA('array');
	});
});