<?php

namespace App\Controller;

use App\Http\Response;

class MainController extends BaseController
{
    public function index(): Response
    {
        return $this->render('main_index');
    }

    public function contact(): Response
    {
        return $this->render('main_contact');
    }
}
