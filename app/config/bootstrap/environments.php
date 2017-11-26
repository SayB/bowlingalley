<?php

#use \Exception;
use lithium\action\Dispatcher;
use lithium\aop\Filters;
use lithium\core\Environment;
use lithium\core\Libraries;

Environment::is(function($request) {
	$host = $request->env('HTTP_HOST');
	$host = strtolower($host);

	if ($host == 'trkr.dev') {
		return 'development';
	}

	if (strpos($host, '.com')) {
		return 'production';
	}

	return 'default';
});