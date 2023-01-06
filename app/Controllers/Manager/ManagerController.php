<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;

class ManagerController extends BaseController
{
    public function index()
    {
        //return redirect()->route('plans')->with('success', 'Você não pode acessar esse menu');
        $data = [
            'title' => 'Home do Manager'
        ];

        return view('Manager/Home/index', $data);
    }
}
