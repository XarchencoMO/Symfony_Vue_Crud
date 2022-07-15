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

}
