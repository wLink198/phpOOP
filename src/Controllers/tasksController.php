<?php
namespace MVC\Controllers;

use MVC\Models\TaskRepository;
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
            if ($this->taskRepository->create($_POST["title"], $_POST["description"]))
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
            if ($this->taskRepository->edit($id, $_POST["title"], $_POST["description"]))
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