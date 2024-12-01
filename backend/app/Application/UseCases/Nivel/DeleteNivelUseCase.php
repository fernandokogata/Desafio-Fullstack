<?php

namespace App\Application\UseCases\Nivel;

use App\Domain\Repositories\NivelRepositoryInterface;
use Illuminate\Http\JsonResponse;

class DeleteNivelUseCase
{
    private NivelRepositoryInterface $nivelRepository;

    public function __construct(NivelRepositoryInterface $nivelRepository)
    {
        $this->nivelRepository = $nivelRepository;
    }

    public function handle(int $id): JsonResponse
    {
        return $this->nivelRepository->delete($id);
    }
}
