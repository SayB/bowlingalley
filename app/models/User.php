<?php

namespace app\models;

use lithium\aop\Filters;
use lithium\util\Validator;
use lithium\storage\Session;
use lithium\security\Password;

class User extends \lithium\data\Model {

	public $validates = [
		'firstname' => [
			[
				'notEmpty'
				, 'required'	=> true
				, 'message'		=> 'Please enter your first name.'
			]
		]
		, 'lastname'	=> [
			[
				'notEmpty'
				, 'required'	=> true
				, 'message'		=> 'Please enter your last name.'
			]
		]
		, 'password'	=> [
			[
				'confirmPassword'
				, 'message'		=> 'Passwords do not match.'
			]
		]
		, 'email'		=> [
			[
				'email'
				, 'message'		=> 'Please provide a valid email.'
			],
			[
				'uniqEmail'
				, 'message'		=> 'Email already exists. Please use a different email.'
			]
		]
	];

	public static function isLoggedIn() {
		if (Session::read('user')) {
			return true;
		}

		return false;
	}
}

Filters::apply('app\models\User', 'save', function($params, $next) {

	$salt = Password::salt('bf', 6);

	if (!empty($params['entity']->password)) {
		$params['entity']->password = Password::hash($params['entity']->password, $salt);
	}
	if (!empty($params['entity']->confirm_password)) {
		$params['entity']->confirm_password = Password::hash($params['entity']->confirm_password, $salt);
	}

	$now = date('Y-m-d H:i:s');
	$params['entity']->modified = $now;
	if (empty($params['entity']->id)) {
		$params['entity']->created = $now;
	}

	return $next($params);

});

Validator::add('confirmPassword', function($value, $type, $params) {
	if (empty($params['values']['confirm_password'])) {
		return false;
	}

	return ($params['values']['password'] == $params['values']['confirm_password']);
});

Validator::add('uniqEmail', function($value, $type, $params) {
	$email = $params['values']['email'];
	$user = \app\models\User::find('first', [
		'conditions' => [
			'email'		=> $email
		]
	]);

	if ($user) {
		return false;
	}

	return true;
});