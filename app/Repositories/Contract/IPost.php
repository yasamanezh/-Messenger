<?php

namespace App\Repositories\Contract;

interface IPost {
     public function takeEnables($take);
     public function related($ids);
     public function comments($id,$paginate);
     public function answers($commentid);
}
