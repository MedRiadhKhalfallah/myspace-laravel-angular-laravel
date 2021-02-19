<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use Illuminate\Http\Request;

class CategorySearchController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryCreateRequest $request
     * @return Illuminate\Http\Request
     */
    public function store(Request $request)
    {
        $categorys = $this->categoryRepository->searchWithCriteria($request->all());
        return $categorys;
    }

}
