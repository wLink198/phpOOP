<?php
namespace MVC\Core;

interface ResourceModelInterface
{
    public function _init($table, $primaryKey);

    public function save($model);

    public function delete($id);
}