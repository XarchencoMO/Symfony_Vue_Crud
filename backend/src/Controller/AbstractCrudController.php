<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

abstract class AbstractCrudController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private string $entityName;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entityName = $this->getEntityFqcn();
    }

    abstract public static function getEntityFqcn(): string;

    abstract public static function getEntityTypeFqcn(): string;

    public function index(): JsonResponse
    {

        $data = $this->entityManager->getRepository($this->entityName)->findAll();
//        $manager =
        return $this->json($data, Response::HTTP_OK, [], [
            AbstractNormalizer::GROUPS => "product_list:read"
        ]);
    }

    /**
     * @throws Exception
     */
    public function addEntity(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            $new_entity = new $this->entityName;

            $form = $this->createForm($this->getEntityTypeFqcn(), $new_entity, [
                'csrf_protection' => false
            ]);

            $form->submit($data);
//            dd($form->isSubmitted(), $form->isValid());
            if (!$form->isSubmitted() || !$form->isValid()) {
                throw new Exception();
            }

            $new_entity = $form->getData();
            $this->entityManager->persist($new_entity);
            $this->entityManager->flush();


            $response = [
                'status' => Response::HTTP_OK,
                'success' => $this->entityName . " added successfully",
            ];
            return $this->json($response);

        } catch (Exception $e) {
            $response = [
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'errors' => "Data no valid",
            ];
            return $this->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function updateEntity(Request $request, $id): JsonResponse
    {
        try {

            $data = json_decode($request->getContent(), true);

            $entity = $this->entityManager->getRepository($this->entityName)->find($id);

            if (!$entity) {
                $data = [
                    'status' => Response::HTTP_NOT_FOUND,
                    'errors' => $this->entityName . " not found",
                ];
                return $this->json($data, Response::HTTP_NOT_FOUND);
            }

            $form = $this->createForm($this->getEntityTypeFqcn(), $entity, [
                'csrf_protection' => false
            ]);

            $form->submit($data);

            if (!$form->isSubmitted() || !$form->isValid()) {
                throw new Exception();
            }

            $this->entityManager->flush();

            $data = [
                'status' => Response::HTTP_OK,
                'success' => $this->entityName . " updated successfully",
            ];
            return $this->json($data);

        } catch (\Exception $e) {
            $data = [
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'errors' => "Data no valid",
            ];
            return $this->json($data, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function deleteEntity($id): JsonResponse
    {
        $entity = $this->entityManager->getRepository($this->entityName)->find($id);
        if (!$entity) {
            $data = [
                'status' => Response::HTTP_NOT_FOUND,
                'errors' => $this->entityName." not found",
            ];
            return $this->json($data, Response::HTTP_NOT_FOUND);
        }
        $this->entityManager->remove($entity);

        $this->entityManager->flush();
        $data = [
            'status' => Response::HTTP_OK,
            'success' => $this->entityName . " deleted successfully",
        ];
        return $this->json($data);
    }

}
