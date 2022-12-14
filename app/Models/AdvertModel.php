<?php

namespace App\Models;

use App\Entities\Advert;

class AdvertModel extends MyBaseModel
{
    private $user;

    public function __construct()
    {
        parent::__construct();

        /**
         * @todo  $this->user = service('auth')->user() ?? auth('api')->user(); // alterar para api
         */

        $this->user = service('auth')->user();
    }

    protected $DBGroup          = 'default';
    protected $table            = 'adverts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Advert::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'category_id',
        'code',
        'title',
        'description',
        'price',
        //'is_published', // nop aqui, pois queremos ter um controle maior de quando o anúncio deverá ser publicado/despublicado
        'situation',
        'zipcode',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

   // Callbacks
   protected $allowCallbacks = true;
   protected $beforeInsert   = ['escapeDataXSS', 'generateCitySlug', 'generateCode', 'setUserID'];
   protected $beforeUpdate   = ['escapeDataXSS', 'generateCitySlug'];

   protected function generateCitySlug(array $data): array
   {
       if (isset($data['data']['city'])) {
           $data['data']['city_slug'] = mb_url_title($data['data']['city'], lowercase: true);
       }
       return $data;
   }

   protected function generateCode(array $data): array
   {
       if (isset($data['data'])) {
           $data['data']['code'] = strtoupper(uniqid('ADVERT_', true));
       }
       return $data;
   }

   protected function setUserID(array $data): array
   {
       if (isset($data['data'])) {
           $data['data']['user_id'] = $this->user->id;
       }
       return $data;
   }

      
   /**
    * Recupera todos os anúncios de acordo com o usuário logado
    *
    * @param  boolean $onlyDeleted
    * @return array
    */
   public function getAllAdverts(bool $onlyDeleted = false)
   {
        $this->setSQLMode();

        $builder = $this;

        if ($onlyDeleted) {

            $builder->onlyDeleted();
        }

        $tableFields = [
            'adverts.*',
            'categories.name AS category',
            'adverts_images.image AS images', // apelido (alias) de images, é ultilizado no métado image() do Entity
        ];

        $builder->select($tableFields);

        // quem está logado é o manager ?
        if (!$this->user->isSuperadmin()) {

            // È o usuario anuncante... então recupera apenas os anúncios dele
            $builder->where('adverts.user_id', $this->user->id);
        }

        
        $builder->join('categories', 'categories.id = adverts.category_id');
        $builder->join('adverts_images', 'adverts_images.advert_id = adverts.id', 'LEFT'); // Nem todos os anúncios térão images
        $builder->groupBy('adverts.id'); // Para não repetir registros
        $builder->orderBy('adverts.id', 'DESC');

        return $builder->findAll();
    }
}
