<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Nivel;
use App\Domain\Repositories\NivelRepositoryInterface;
use App\Infrastructure\Models\NivelModel;
use Exception;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentNivelRepository implements NivelRepositoryInterface
{

    public function create(Nivel $nivel): NivelModel|JsonResponse|Response
    {
        try {
            return NivelModel::create([
                'nivel' => $nivel->getNivel()
            ]);
        } catch (Exception $e) {
            return response('Erro ao criar Nível.', 400);
        }
    }

    public function update(Nivel $nivel): JsonResponse|Response
    {
        try {
            $nivelModel = NivelModel::find($nivel->getId());
            if(!$nivelModel) {
                return response('Nível não encontrado..', 400);
            }
            $nivelModel->nivel = $nivel->getNivel();
            if ($nivelModel->update()) {
                return response()->json($nivel->value());
            }
        } catch (Exception $e) {
            return response('Erro ao atualizar nível.', 400);
        }
        return response('Erro ao atualizar nivel.', 400);
    }

    public function find(array|string|null $queryParams): LengthAwarePaginator|Collection|JsonResponse|Response
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
                return response('Não há Niveis cadastrados.', 404);
            } catch (Exception $e) {
                return response('Erro ao buscar Níveis.', 400);
            }
        }

        if (isset($queryParams['nivel'])) {
            $query->where('nivel', 'like', '%' . $queryParams['nivel'] . '%');
        }
        $this->orderBy($query, $queryParams, $orderBy, $columns);
        return $query->paginate($queryParams['limit'] ?? 10);
    }

    public function delete(int $id): JsonResponse|Response
    {
        try {
            if (NivelModel::destroy($id)) {
                return response()->noContent();
            }
        } catch (Exception $e) {
            return response('Erro ao deletar Nível.', 400);
        }
        return response('Erro ao deletar Nível.', 400);
    }

    private function orderBy(Builder $query, array|string $queryParams, array $orderBy, array $columns): void
    {
        if (isset($queryParams['order_direction']) &&
            in_array($queryParams['order_direction'], $orderBy) &&
            isset($queryParams['order_column']) &&
            in_array($queryParams['order_column'], $columns)) {
            $query->orderBy($queryParams['order_column'], $queryParams['order_direction']);
        }
    }
}
