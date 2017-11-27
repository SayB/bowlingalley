<?php

namespace app\models;

use lithium\aop\Filters;

class Frame extends \lithium\data\Model {

	public $belongsTo = 'Game';
}

Filters::apply('app\models\Frame', 'save', function($params, $next) {

	$now = date('Y-m-d H:i:s');
	$params['entity']->modified = $now;
	if (empty($params['entity']->id)) {
		$params['entity']->created = $now;
	}

	return $next($params);

});