<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\ReadTaskDto;
use App\Dto\WriteTaskDto;
use App\Form\Type\TaskType;
use App\Manager\TaskManager;
use App\Mapper\TaskMapper;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CreateTaskController extends TaskController
{
    private FormFactoryInterface $formFactory;

    private SerializerInterface $serializer;

    public function __construct(TaskManager $manager, TaskMapper $mapper, FormFactoryInterface $formFactory, SerializerInterface $serializer)
    {
        parent::__construct($manager, $mapper);
        $this->formFactory = $formFactory;
        $this->serializer = $serializer;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $dto = new WriteTaskDto();
        $form = $this->formFactory->create(TaskType::class, $dto);
        $form->submit(json_decode($request->getContent(), true));
        if (!$form->isSubmitted() || !$form->isValid()) {
            return new JsonResponse($this->serializer->serialize($form, 'json'), Response::HTTP_BAD_REQUEST, [], true);
        }
        $entity = $this->manager->create();
        $this->mapper->writeEntity($dto, $entity);
        $this->manager->flush();
        $dto = new ReadTaskDto();
        $this->mapper->readEntity($entity, $dto);
        return new JsonResponse($dto, Response::HTTP_CREATED);
    }
}
