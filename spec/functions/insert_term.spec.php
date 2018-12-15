<?php

describe('insert_term()', function ()
{
	it('insert terms to Term API', function(){
		expect(insert_term([
			'token' => '14b356d30646abf3bcaa08160633c55b',
			'keyword' => 'new keyword',
		]))->toBeA('object');
	});
});