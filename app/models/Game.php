<?php

namespace app\models;

use lithium\aop\Filters;

class Game extends \lithium\data\Model {

	public $belongsTo = 'User';
	public $hasMany = ['Frame'];
}

Filters::apply('app\models\Game', 'save', function($params, $next) {

	$now = date('Y-m-d H:i:s');
	$params['entity']->modified = $now;
	if (empty($params['entity']->id)) {
		$params['entity']->created = $now;
	}

	return $next($params);

});