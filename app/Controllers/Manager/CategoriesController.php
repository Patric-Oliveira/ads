<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Entities\Category;
use App\Requests\CategoryRequest;
use App\Services\CategoryService;
use CodeIgniter\Config\Factories;

class CategoriesController extends BaseController
{
    private $categoryService;
    private $categoryRequest;

    public function __construct()
    {
        $this->categoryService = Factories::class(CategoryService::class);
        $this->categoryRequest = Factories::class(CategoryRequest::class);
    }

    public function index()
    {
        $data = [
            'title' => 'Categorias'
        ];

        return view('Manager/Categories/index', $data);
    }

    public function getAllCategories()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }
        
        return $this->response->setJSON(['data' => $this->categoryService->getAllCategories()]);
    }

    public function getCategoryInfo()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $category = $this->categoryService->getCategory($this->request->getGetPost('id'));

        $options = [
            'class'         => 'form-control',
            'placeholder'   => 'Escolha...',
            'selected'      => !(empty($category->parent_id)) ? $category->parent_id : "",
        ];

        $response = [
            'category' => $category,
            'parents'  => $this->categoryService->getMultinivel('parent_id', $options),
        ];

        return $this->response->setJSON($response);
    }

    public function create()
    {
        $this->categoryRequest->validateBeforeSave('category');
        
        $category = new Category($this->removeSpoofingFromRequest());

        $this->categoryService->trySaveCategory($category);

        return $this->response->setJSON($this->categoryRequest->respondWithMessage(message: 'Dados Salvos Com Sucesso!'));
    }

    public function update()
    {
        $this->categoryRequest->validateBeforeSave('category');

        $category = $this->categoryService->getCategory($this->request->getGetPost('id'));

        $category->fill($this->removeSpoofingFromRequest());

        $this->categoryService->trySaveCategory($category);

        return $this->response->setJSON($this->categoryRequest->respondWithMessage(message: 'Dados Salvos Com Sucesso!'));
    }

    public function getDropdownParents()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $options = [
            'class'         => 'form-control',
            'placeholder'   => 'Escolha...',
            'selected'      => " ",
        ];

        $response = [
            'parents'  => $this->categoryService->getMultinivel('parent_id', $options),
        ];

        return $this->response->setJSON($response);

    }
}
