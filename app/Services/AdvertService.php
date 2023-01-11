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

        $data = [];

        $baseRouteToEditImages = $this->user->isSuperadmin() ? 'adverts.manager.edit.images' : 'adverts.my.edit.images';
        $baseRouteToQuestions = $this->user->isSuperadmin() ? 'adverts.manager.edit.questions' : 'adverts.my.edit.questions';

        foreach ($adverts as $advert) {

            $btnEdit = form_button(
                [
                    'data-id' => $advert->id,
                    'id'      => 'btnEditAdvert', 
                    'class'   => 'dropdown-item'
                ],
                'Editar'
            );

            $finalRouteToEditImages = route_to($baseRouteToEditImages. $advert->id);

            $btnEditImages = form_button(
                [
                    'class'    => 'dropdown-item',
                    'onClick'  => "location.href='{$finalRouteToEditImages}'", 
                ],
                'Imagens'
            );

            // montar botão de ações do dropdown
            $btnActions = '<div class="dropdown dropup">'; // abertura da div do dropdown

            $attrBtnActions = [
                'type'           => 'button',
                'id'             => 'actions',
                'class'          => "dropdown-toggle {$classBtnActions}",
                'data-bs-toggle' => "dropdown", // Para BS5
                'data-toggle'    => "dropdown", // Para BS4
                'aria-haspopup'  => "true",
                'aria-expanded'  => "false",
            ];

            $btnActions .= form_button($attrBtnActions, 'Ações');

            $btnActions .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'; // abertura da div do dropdpwn menu

            $btnActions .= $btnEdit;
            $btnActions .= $btnEditImages;

            $btnActions .= '</div>'; // fechamento da div do dropdown-menu

            $btnActions .= '</div>'; // fechamento da div do dropdown 


            $data[] = [
                'image'         => $advert->image(),
                'title'         => $advert->title,
                'code'          => $advert->code,
                'category'      => $advert->category,
                'is_published'  => $advert->isPublished(),
                'address'       => $advert->address(),
                'actions'       => $btnActions,
            ];
        }

        return $data;
    }
}
