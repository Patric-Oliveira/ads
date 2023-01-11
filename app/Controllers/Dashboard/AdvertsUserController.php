<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Services\AdvertService;
use CodeIgniter\Config\Factories;

class AdvertsUserController extends BaseController
{
    private $advertService;

    public function __construct()
    {
        $this->advertService = Factories::class(AdvertService::class);
    }

    public function index()
    {
        dd($this->advertService->getAllAdverts());
        return view('Dashboard/Adverts/index');
    }
}
