<?php

namespace App\Repositories\Contract;

interface INoTranslateBase {
    public function all($field,$search);
    public  function UpdatedSelectPage($value,$param);
    public function chanseStatus($param);
    public function delete($id);
    public function deleteAll($ids);
    public function create($data);
    public function update($id,$data);
    public function find($id);
    public function first();
    public function search($array,$search);
}
