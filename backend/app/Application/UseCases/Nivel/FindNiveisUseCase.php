<?php

namespace App\Application\UseCases\Nivel;

use App\Domain\Repositories\NivelRepositoryInterface;
use Illuminate\Http\Response;

class FindNiveisUseCase
{
    private NivelRepositoryInterface $repository;

    public function __construct(NivelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(array|string|null $queryParams): array|Response
    {
        $response = $this->repository->find($queryParams)->toArray();
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
