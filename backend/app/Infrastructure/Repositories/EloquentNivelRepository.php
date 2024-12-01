<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Nivel;
use App\Domain\Repositories\NivelRepositoryInterface;
use App\Infrastructure\Models\NivelModel;
use Exception;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentNivelRepository implements NivelRepositoryInterface
{

    public function create(Nivel $nivel): NivelModel|JsonResponse
    {
        try {
            return NivelModel::create([
                'nivel' => $nivel->getNivel()
            ]);
        } catch (Exception $e) {
            return response()->json($nivel->value(), 400);
        }
    }

    public function update(Nivel $nivel): JsonResponse
    {
        try {
            $nivelModel = NivelModel::find($nivel->getId());
            $nivelModel->nivel = $nivel->getNivel();
            if ($nivelModel->update()) {
                return response()->json($nivel->value());
            }
        } catch (Exception $e) {
            return response()->json($nivel->value(), 400);
        }
        return response()->json($nivel->value(), 400);
    }

    public function findAll(array|string|null $queryParams): LengthAwarePaginator|Collection|JsonResponse
    {
        $orderBy = ['asc', 'desc'];
        $columns = ['id', 'nivel'];
        $query = NivelModel::query();

        if (is_null($queryParams)) {
            try {
                $response = NivelModel::all();
                if ($response->toArray() != null) {
                    return $response;
                }
                return response()->json([], 404);
            } catch (Exception $e) {
                return response()->json('Erro ao buscar níveis: ' . $e->getMessage(), 400);
            }
        }

        if (isset($queryParams['nivel'])) {
            $query->where('nivel', 'like', '%' . $queryParams['nivel'] . '%');
        }
        $this->orderBy($query, $queryParams, $orderBy, $columns);
        return $query->paginate($queryParams['limit'] ?? 10);
    }

    public function delete(int $id): JsonResponse
    {
        try {
            if (NivelModel::destroy($id)) {
                return response()->json([], 204);
            }
        } catch (Exception $e) {
            return response()->json([], 400);
        }
        return response()->json([], 400);
    }

    private function orderBy(Builder $query, array $queryParams, array $orderBy, array $columns): void
    {
        if (isset($queryParams['order_direction']) &&
            in_array($queryParams['order_direction'], $orderBy) &&
            isset($queryParams['order_column']) &&
            in_array($queryParams['order_column'], $columns)) {
            $query->orderBy($queryParams['order_column'], $queryParams['order_direction']);
        }
    }
}
