<?php

namespace app\controllers;

use app\models\User;
use app\models\Game;
use app\models\Frame;
use lithium\action\Response;
use lithium\storage\Session;

class ScoresController extends \lithium\action\Controller {

	public function __construct(array $config = []) {
		if (!User::isLoggedIn()) {
			return new Response([
				''
			]);
		}
		$config['render']['layout'] = 'bowlingalley';
		parent::__construct($config);
	}

	public function save() {
		if (!$this->request->is('ajax')) {
			return;
		}

		if (!isset($this->request->data['jsonData'])) {
			return false;
		}

		$data = json_decode($this->request->data['jsonData'], true);
		$frames = [];

		foreach ($data as $k => $v) {
			if ($k == 0) {
				continue;
			}

			$user = Session::read('user');

			foreach ($v['rolls'] as $attempt => $pins) {
				$frames[] = [
					'number'		=> $k,
					'roll'			=> ($attempt == 'bonus') ? 3 : $attempt,
					'pins'			=> $pins
				];
			}
		}

		$score = $data[count($data) - 1]['score'];

		$game = Game::create(['user_id' => $user['id'], 'score' => $score]);

		if ($game->save()) {
			foreach ($frames as $_frame) {
				$_frame['game_id'] = $game->id;
				$f = Frame::create($_frame);
				$f->save();
			}
		}
	}

	public function index() {}
	public function view() {}

}