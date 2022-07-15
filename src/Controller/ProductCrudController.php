<?php

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use phpDocumentor\Reflection\Types\Collection;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
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

    /**
     * @return JsonResponse
     * @Route("/products", name="products", methods={"GET"})
     */
    public function index(): JsonResponse
    {
        return parent::index();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/products", name="products_add", methods={"POST"})
     */
    public function addEntity(Request $request): JsonResponse
    {
        return parent::addEntity($request);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @Route("/products/{id}", name="products_put", methods={"PUT"})
     */
    public function updateEntity(Request $request, $id): JsonResponse
    {
        return parent::updateEntity($request, $id);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @Route("/products/{id}", name="products_delete", methods={"DELETE"})
     */
    public function deleteEntity($id): JsonResponse
    {
        return parent::deleteEntity($id);
    }

}
