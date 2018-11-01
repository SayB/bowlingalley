<?php

namespace app\controllers;

use app\models\User;
use app\models\Task;
use lithium\storage\Session;
use lithium\security\Auth;

class TasksController extends \lithium\action\Controller {

    public $requireAuth = ['logout'];

    public function __construct(array $config = []) {
        $config['render']['layout'] = 'bowlingalley';
        parent::__construct($config);
    }

    public function add($id = null) {
        $task = Task::create();

        if (!empty($id)) {
            $task = Task::find('first', [
                'conditions'    => [
                    'id'    => $id
                ]
            ]);
        }

        if (!empty($this->request->data)) {
            $task->set($this->request->data);

            if ($task->save()) {
                Session::write('flash.success', 'Task added successfully.');
                $this->redirect('/tasks');
            } else {
                Session::write('flash.failure', 'Cannot save. Please check the errors below.');
            }
        }

        $this->render(['data' => compact('task')]);
    }

    public function index() {
        $tasks = Task::allWithChildren();

        $this->render(['data' => compact('tasks')]);
    }
}
