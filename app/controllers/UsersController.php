<?php

namespace app\controllers;

use app\models\User;
use lithium\storage\Session;
use lithium\security\Auth;

class UsersController extends \lithium\action\Controller {

	public $requireAuth = ['logout'];

	public function __construct(array $config = []) {
		$config['render']['layout'] = 'bowlingalley';
		parent::__construct($config);
	}

	public function register() {

		$user = User::create();

		if ($this->request->is('post')) {
			$data = $this->request->data;
			$user->set($data);

			if ($user->save()) {
				Session::write('flash.success', 'User saved successfully.');
				$this->redirect('/users/register');
				return;
			}

			Session::write('flash.failure', 'Cannot save. Please check the errors below.');
		} else {
//			$data = [
//				'firstname'				=> 'Sohaib'
//				, 'lastname'			=> 'Muneer'
//				, 'email'				=> 'sohaib.muneer@gmail.com'
//				, 'password'			=> 'sayb1234'
//				, 'confirm_password'	=> 'sayb1234'
//			];
//			$user->set($data);
		}

		$this->render(['data' => compact('user')]);
	}

	public function login() {

		if ($this->request->is('post')) {
			$isGood = Auth::check('user', $this->request, [
				'persist' => [
					'id', 'firstname', 'lastname', 'email'
				]
			]);

			$msgs = [
				'flash.failure'		=> 'Invalid Email and / or Password.'
				, 'flash.success'	=> 'Logged in Successfully!'
			];

			$key = 'flash.failure';
			if ($isGood) {
				$key = 'flash.success';
			}

			Session::write($key, $msgs[$key]);

			$user = User::find('first', [
				'conditions'	=> [
					'email'		=> $this->request->data['email']
				]
			]);

			Auth::set('user', $user->data());

			$this->redirect('/');
			return;
		}

		$this->render([
			'data'		=> [
				'user'	=> User::create()
			]
		]);
	}

	public function logout() {
		Auth::clear('user');

		Session::write('flash.success', 'You\'ve been logged out successfully.');

		$this->redirect('/');
	}
}
