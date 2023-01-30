<?php

namespace App\Repositories\Contract;

interface IPack {
    public function getOptions();
    public function getPackOptions($id);
    public function getOptionModel();
    public function syncOption($id, $datas);
    public function attachOption($id, $datas);
}
