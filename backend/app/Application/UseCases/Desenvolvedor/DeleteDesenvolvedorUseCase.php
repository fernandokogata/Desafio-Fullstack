<?php

namespace App\Application\UseCases\Desenvolvedor;

use App\Domain\Repositories\DesenvolvedorRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DeleteDesenvolvedorUseCase
{
    private DesenvolvedorRepositoryInterface $repository;

    public function __construct(DesenvolvedorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(int $id): JsonResponse|Response
    {
        return $this->repository->delete($id);
    }
}
