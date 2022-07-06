<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * Class ProductCrudController
 * @package App\Controller
 * @Route("/api", name="post_api")
 */
class ProductCrudController extends AbstractController
{
//    /**
//     * @Route("/product/crud", name="app_product_crud")
//     */
//    public function index(): Response
//    {
//        return $this->render('product_crud/index.html.twig', [
//            'controller_name' => 'ProductCrudController',
//        ]);
//    }

    /**
     * @param ProductRepository $productRepository
     * @return JsonResponse
     * @Route("/products", name="products", methods={"GET"})
     */
    public function getProducts(ProductRepository $productRepository): JsonResponse
    {
        $data = $productRepository->findAll();
        return $this->response($data);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param ProductRepository $productRepository
     * @return JsonResponse
     * @throws Exception
     * @Route("/products", name="products_add", methods={"POST"})
     */
    public function addProduct(Request $request, EntityManagerInterface $entityManager, ProductRepository $productRepository): JsonResponse
    {

        try{
            $request = $this->transformJsonBody($request);

            if (!$request || !$request->get('name') || !$request->request->get('description')){
                throw new Exception();
            }

            $product = new Product();
            $product->setName($request->get('name'));
            $product->setDescription($request->get('description'));

            $entityManager->persist($product);
            $entityManager->flush();


            // TODO: Сделать добавление категорий

            $data = [
                'status' => 200,
                'success' => "Product added successfully",
            ];
            return $this->response($data);

        }catch (Exception $e){
            $data = [
                'status' => 422,
                'errors' => "Data no valid",
            ];
            return $this->response($data, 422);
        }

    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param ProductRepository $productRepository
     * @param $id
     * @return JsonResponse
     * @Route("/products/{id}", name="products_put", methods={"PUT"})
     */
    public function updateProduct(Request $request, EntityManagerInterface $entityManager, ProductRepository $productRepository, $id): JsonResponse
    {

        try{
            $post = $productRepository->find($id);

            if (!$post){
                $data = [
                    'status' => 404,
                    'errors' => "Post not found",
                ];
                return $this->response($data, 404);
            }

            $request = $this->transformJsonBody($request);

            if (!$request || !$request->get('name') || !$request->request->get('description')){
                throw new \Exception();
            }

            $post->setName($request->get('name'));
            $post->setDescription($request->get('description'));
            $entityManager->flush();

            $data = [
                'status' => 200,
                'errors' => "Post updated successfully",
            ];
            return $this->response($data);

        }catch (\Exception $e){
            $data = [
                'status' => 422,
                'errors' => "Data no valid",
            ];
            return $this->response($data, 422);
        }

    }

    /**
     * @param ProductRepository $productRepository
     * @param $id
     * @return JsonResponse
     * @Route("/products/{id}", name="products_delete", methods={"DELETE"})
     */
    public function deleteProduct(EntityManagerInterface $entityManager, ProductRepository $productRepository, $id): JsonResponse
    {
        $post = $productRepository->find($id);

        if (!$post){
            $data = [
                'status' => 404,
                'errors' => "Post not found",
            ];
            return $this->response($data, 404);
        }

        $entityManager->remove($post);
        $entityManager->flush();
        $data = [
            'status' => 200,
            'errors' => "Post deleted successfully",
        ];
        return $this->response($data);
    }

    /**
     * Returns a JSON response
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    public function response(array $data, int $status = 200, array $headers = []): JsonResponse
    {
        return new JsonResponse($data, $status, $headers);
    }

    protected function transformJsonBody(Request $request): Request
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }

}
