<?php

namespace app\controllers;

class ScoresController extends \lithium\action\Controller {

	public function __construct(array $config = []) {
		$config['render']['layout'] = 'bowlingalley';
		parent::__construct($config);
	}

	public function index() {}
	public function view() {}
}
