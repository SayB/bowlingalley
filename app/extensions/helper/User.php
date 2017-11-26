<?php

namespace app\extensions\helper;

use lithium\storage\Session;


class User extends \lithium\template\Helper {

	public function isLoggedIn() {
		if (Session::read('user')) {
			return true;
		}

		return false;
	}

	public function name() {
		if (!$this->isLoggedIn()) {
			return;
		}

		$data = $this->read();
		return $data['firstname'] . ' ' . $data['lastname'];
	}

	public function read($key = null) {
		if (!$key) {
			$key = 'user'; // okay hardcoding such values is NOT COOL - but bare with me please :|
		} else {
			$key = 'user.' . $key;
		}

		return Session::read($key);
	}
}