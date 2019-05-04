<?php
namespace MVC\Models;

use MVC\Models\TaskResourceModel;
use MVC\Models\Task;

class TaskRepository
{
    protected $trm;

    function __construct()
    {
        $this->trm = new TaskResourceModel();
    }

    public function showAllTasks()
    {
        return $this->trm->all();
    }

    public function create($title, $des) {
        $task = new Task();
        $task->setTitle($title);
        $task->setDescription($des);

        return $this->trm->save($task);
    }

    public function showTask($id)
    {
        return $this->trm->find($id);
    }

    public function edit($id, $title, $des)
    {
        $task = new Task();
        $task->setTitle($title);
        $task->setDescription($des);
        return $this->trm->update($id, $task);
    }

    public function delete($id)
    {
        return $this->trm->delete($id);
    }
}