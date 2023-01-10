<?php

namespace App\Services;

use App\Models\AdvertModel;
use CodeIgniter\Config\Factories;

class AdvertService
{
    private $user;
    private $advertModel;

    public const SITUATION_NEW = 'new';
    public const SITUATION_USED  = 'used';

    public function __construct()
    {
        /**
         * @todo alterar para auth('api)->user()... 
         */
        $this->user = service('auth')->user();

        $this->advertModel = Factories::models(AdvertModel::class);
    }

    public function getAllAdverts(
        bool $showBtnArchive = true,
        bool $showBtnViewAdvert = true,
        bool $showBtnQuestions = true,
        string $classBtnActions = 'btn btn-primary btn-sm',
        string $sizeImage = 'small',
    ): array {
        
        $adverts = $this->advertModel->getAllAdverts();
    }
}
