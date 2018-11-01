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
				$this->redirect('/users/login');
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

	    $ceo = User::find('first', [
	        'conditions'    => ['email' => 'ceo@todoapp.dev']
        ]);

		if (!empty($this->request->data)) {
		    $ans = false;
		    if (!empty($this->request->data['answer'])) {
		        $ans = $this->request->data['answer'];
            }

            $isGood = true;
            if ($ans !== $ceo->answer) {
		        $isGood = false;
            }

			$msgs = [
				'flash.failure'		=> 'Invalid Answer!'
				, 'flash.success'	=> 'Logged in Successfully!'
			];

			$key = 'flash.failure';
			$redirect = '/tasks/add';
			if ($isGood && $ceo) {
				$key = 'flash.success';
				$redirect = '/';
				Auth::set('user', $ceo->data());
			}

			Session::write($key, $msgs[$key]);

			$this->redirect($redirect);
			return;
		}

		$this->render([
			'data'		=> [
				'user'	=> $ceo
			]
		]);
	}

	public function logout() {
		Auth::clear('user');

		Session::write('flash.success', 'You\'ve been logged out successfully.');

		$this->redirect('/');
	}
}
