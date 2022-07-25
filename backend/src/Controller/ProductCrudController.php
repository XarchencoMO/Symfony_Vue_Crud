<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductCrudController
 * @package App\Controller
 * @Route("/api", name="product_api")
 */
class ProductCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public static function getEntityTypeFqcn(): string
    {
        return ProductType::class;
    }

}
