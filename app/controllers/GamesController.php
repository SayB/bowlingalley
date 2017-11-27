<?php

namespace app\controllers;

use app\models\User;
use app\models\Game;
use app\models\Frame;
use lithium\action\Response;
use lithium\storage\Session;

class GamesController extends \lithium\action\Controller {

	public function __construct(array $config = []) {
		if (!User::isLoggedIn()) {
			return new Response([
				''
			]);
		}
		$config['render']['layout'] = 'bowlingalley';
		parent::__construct($config);
	}

	public function index() {
		$user = Session::read('user');
		$games = Game::find('all', [
			'conditions' => ['user_id' => $user['id']]
		]);
		$this->render(['data' => compact('games')]);
	}

}