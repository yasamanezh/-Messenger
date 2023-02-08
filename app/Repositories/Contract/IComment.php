<?php

namespace App\Repositories\Contract;

interface IComment {
  public function getComment($search,$sortColumnName,$sortDirection,$count_data);
}
