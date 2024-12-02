<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Desenvolvedor;
use App\Infrastructure\Models\DesenvolvedorModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

interface DesenvolvedorRepositoryInterface
{
    public function create(Desenvolvedor $desenvolvedor): DesenvolvedorModel|JsonResponse|Response;
    public function find(array|string|null $queryParams): LengthAwarePaginator|Collection|JsonResponse|Response;
    public function update(Desenvolvedor $desenvolvedor): DesenvolvedorModel|JsonResponse|Response;
    public function delete(int $id): JsonResponse|Response;
}
