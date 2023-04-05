<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Noautorizado extends BaseController
{
    public function getIndex()
    {
       return
       view('templates/header') .
       view('templates/noautorizado') .
       view('templates/footer');
    }
}
