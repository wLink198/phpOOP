<?php
namespace MVC\Models;

use MVC\Core\ResourceModel;

class TaskResourceModel extends ResourceModel
{
    protected $table = "tasks";
    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->_init($this->table, $this->primaryKey);
    }
}
?>