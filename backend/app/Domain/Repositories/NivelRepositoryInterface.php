<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Nivel;
use App\Infrastructure\Models\NivelModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

interface NivelRepositoryInterface
{
    public function create(Nivel $nivel): NivelModel|JsonResponse;

    public function findAll(array|string|null $queryParams): LengthAwarePaginator|Collection|JsonResponse;

    public function update(Nivel $nivel): NivelModel|JsonResponse;

    public function delete(int $id): JsonResponse;
}
