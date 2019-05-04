<?php
namespace MVC\Controllers;

use MVC\Models\TaskRepository;
use MVC\Models\Task;
use MVC\Core\Controller;

class tasksController extends Controller
{
    protected $taskRepository;

    function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    function index()
    {
        $d['tasks'] = $this->taskRepository->showAllTasks();
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        if (isset($_POST["title"]))
        {
            $task = new Task();
            $task->setTitle($_POST["title"]);
            $task->setDescription($_POST["description"]);
            if ($this->taskRepository->create($task))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

        $this->render("create");
    }

    function edit($id)
    {
        $d["task"] = $this->taskRepository->showTask($id);

        if (isset($_POST["title"]))
        {
            $task = new Task();
            $task->setTitle($_POST["title"]);
            $task->setDescription($_POST["description"]);
            if ($this->taskRepository->edit($id, $task))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        if ($this->taskRepository->delete($id))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
?>