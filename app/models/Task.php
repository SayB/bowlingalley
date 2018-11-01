<?php

namespace app\models;

use lithium\aop\Filters;

class Task extends \lithium\data\Model {

    public $validates = [
        'title' => [
            [
                'notEmpty'
                , 'required'	=> true
                , 'message'		=> 'Please enter task title.'
            ]
        ]
    ];

    public function getChildren() {
        $data = $this->data();
        return self::find('all', [
            'conditions'    => [
                'parent_id' => $data['id']
            ]
        ]);
    }

    public static function allWithChildren() {
        $parents = self::find('all', [
            'conditions'    => [
                'parent_id' => null
            ]
        ]);

        foreach ($parents as $p) {
            $children = self::find('all', ['conditions' => [
                'parent_id' => $p->id
            ]]);

            $p->children = $children;
        }

        return $parents;
    }
}
