<?php
namespace MVC\Models;

use MVC\Models\TaskResourceModel;

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

    public function create($model) {
        return $this->trm->save($model);
    }

    public function showTask($id)
    {
        return $this->trm->find($id);
    }

    public function edit($id, $model)
    {
        return $this->trm->update($id, $model);
    }

    public function delete($id)
    {
        return $this->trm->delete($id);
    }
}