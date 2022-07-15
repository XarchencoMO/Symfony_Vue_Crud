<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryCrudController
 * @package App\Controller
 * @Route("/api", name="category_api")
 */
class CategoryCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public static function getEntityTypeFqcn(): string
    {
        return CategoryType::class;
    }

    /**
     * @return JsonResponse
     * @Route("/categories", name="categories", methods={"GET"})
     */
    public function index(): JsonResponse
    {
        return parent::index();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/categories", name="categories_add", methods={"POST"})
     */
    public function addEntity(Request $request): JsonResponse
    {
        return parent::addEntity($request);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @Route("/categories/{id}", name="categories_put", methods={"PUT"})
     */
    public function updateEntity(Request $request, $id): JsonResponse
    {
        return parent::updateEntity($request, $id);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @Route("/categories/{id}", name="categories_delete", methods={"DELETE"})
     */
    public function deleteEntity($id): JsonResponse
    {
        return parent::deleteEntity($id);
    }


}
