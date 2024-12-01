<?php

namespace App\Application\UseCases\Nivel;

use App\Domain\Repositories\NivelRepositoryInterface;

class FindAllNiveisUseCase
{
    private NivelRepositoryInterface $nivelRepository;

    public function __construct(NivelRepositoryInterface $nivelRepository)
    {
        $this->nivelRepository = $nivelRepository;
    }

    public function handle(array|string|null $queryParams): array
    {
        $response = $this->nivelRepository->findAll($queryParams)->toArray();
        return [
            'data' => $response['data'],
            'meta' => [
                'total' => $response['total'],
                'current_page' => $response['current_page'],
                'last_page' => $response['last_page'],
                'per_page' => $response['per_page'],
            ]
        ];
    }
}
