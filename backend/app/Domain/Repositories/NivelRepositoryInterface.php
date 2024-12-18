<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Nivel;
use App\Infrastructure\Models\NivelModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

interface NivelRepositoryInterface
{
    public function create(Nivel $nivel): NivelModel|JsonResponse|Response;
    public function find(array|string|null $queryParams): LengthAwarePaginator|Collection|JsonResponse|Response;
    public function update(Nivel $nivel): JsonResponse|Response;
    public function delete(int $id): JsonResponse|Response;
}
