<?php

namespace App\Repositories\Contract;

interface iBlog {
    public function activePosts($search = '', $slug,$paginate );
    public function activePostsGet() ;
}
