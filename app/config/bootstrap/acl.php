<?php

use lithium\aop\Filters;
use lithium\action\Dispatcher;
use lithium\action\Response;

use app\models\User;

Filters::apply(Dispatcher::class, '_callable', function($params, $next) {
	$ctrl    = $next($params);
	$request = isset($params['request']) ? $params['request'] : null;
	$action  = $params['params']['action'];
	$requireAuth = (isset($ctrl->requireAuth) && in_array($action, $ctrl->requireAuth));

	if (!$requireAuth) {
		return $ctrl;
	}

	if (User::isLoggedIn()) {
		return $ctrl;
	}

	if ($ctrl instanceof \app\Controllers\UsersController && $action == 'login') {
		return $ctrl;
	}

	return function() use ($request) {
		return new Response(compact('request') + ['location' => 'Users::login']);
	};
});