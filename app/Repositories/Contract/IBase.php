<?php

namespace App\Repositories\Contract;

interface IBase {
    public function all($search);
    public  function UpdatedSelectPage($value,$param);
    public function chanseStatus($param);
    public function delete($id);
    public function deleteAll($ids);
    public function create($data,$translate);
    public function update($id,$data,$translate);
    public function getLanguage();
    public function find($id);
    public function findBySlug($slug);
    public function getCurrentTitle($id);
    public function get();
    public function first();
    public function getEnables();
    public function takeByEnable($count); 
    public function PaginateEnables($count,$slug =null) ;
     public function findEnable($id) ;
    
    
}
