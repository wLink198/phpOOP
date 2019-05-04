<?php
namespace MVC\Core;

use MVC\Core\ResourceModelInterface;
use MVC\Config\Database;
require_once('..\Config\db.php');

class ResourceModel implements ResourceModelInterface
{
    protected $table;
    protected $primaryKey;

    public function _init($table, $primaryKey)
    {
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    public function save($model) {
        $sql = "INSERT INTO $this->table (";
        $array = get_object_vars($model);

        foreach ($array as $key => $value) {
            $sql = $sql." $key,";
        }
        $sql = $sql." created_at, updated_at) VALUES (";

        foreach ($array as $key => $value) {
            $sql = $sql." :$key,";
        }
        $sql = $sql." :created_at, :updated_at)";

        $req = Database::getBdd()->prepare($sql);

        $execute = [];
        foreach ($array as $key => $value) {
            $execute[$key] = $value;
        }
        $execute['created_at'] = date('Y-m-d H:i:s');
        $execute['updated_at'] = date('Y-m-d H:i:s');
        return $req->execute($execute);
    }

    public function find($id) {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function all() {
        $sql = "SELECT * FROM $this->table";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function update($id, $model)
    {
        $sql = "UPDATE $this->table SET";
        $array = get_object_vars($model);

        foreach ($array as $key => $value) {
            $sql = $sql." $key = :$key,";   
        }

        $sql = $sql." updated_at = :updated_at WHERE $this->primaryKey = $id";
        $req = Database::getBdd()->prepare($sql);

        $execute = [];
        foreach ($array as $key => $value) {
            $execute[$key] = $value;
        }
        $execute['updated_at'] = date('Y-m-d H:i:s');
        return $req->execute($execute);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }
}
?>