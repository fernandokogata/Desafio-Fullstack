<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Desenvolvedor;
use App\Domain\Repositories\DesenvolvedorRepositoryInterface;
use App\Infrastructure\Models\DesenvolvedorModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentDesenvolvedorRepository implements DesenvolvedorRepositoryInterface
{

    public function create(Desenvolvedor $desenvolvedor): DesenvolvedorModel|JsonResponse|Response
    {
        try {
            return DesenvolvedorModel::create([
                'nivel_id' => $desenvolvedor->getNivelId(),
                'nome' => $desenvolvedor->getNome(),
                'sexo' => $desenvolvedor->getSexo(),
                'data_nascimento' => $desenvolvedor->getDataNascimento(),
                'hobby' => $desenvolvedor->getHobby()
            ]);
        } catch (Exception $exception) {
            return response(null, 400);
        }
    }

    public function update(Desenvolvedor $desenvolvedor): JsonResponse|Response
    {
        try {
            $desenvolvedorModel = DesenvolvedorModel::find($desenvolvedor->getId());
            if(!$desenvolvedorModel) {
                return response(null, 400);
            }
            $desenvolvedorModel->nivel_id = $desenvolvedor->getNivelId();
            $desenvolvedorModel->nome = $desenvolvedor->getNome();
            $desenvolvedorModel->sexo = $desenvolvedor->getSexo();
            $desenvolvedorModel->data_nascimento = $desenvolvedor->getDataNascimento();
            $desenvolvedorModel->hobby = $desenvolvedor->getHobby();
            if ($desenvolvedorModel->update()) {
                return response()->json($desenvolvedor->value());
            }
        } catch (Exception $e) {
            return response(null, 400);
        }
        return response(null, 400);
    }

    public function find(array|string|null $queryParams): LengthAwarePaginator|Collection|JsonResponse|Response
    {
        $orderBy = ['asc', 'desc'];
        $columns = ['id', 'nivel_id', 'nome', 'sexo', 'data_nascimento', 'hobby'];
        $query = DesenvolvedorModel::query();

        if (is_null($queryParams)) {
            try {
                $response = DesenvolvedorModel::all();
                if ($response->toArray() != null) {
                    return $response;
                }
                return response(null, 404);
            } catch (Exception $e) {
                return response(null, 400);
            }
        }
        $this->filterQuery($query, $queryParams, 'nome');
        $this->filterQuery($query, $queryParams, 'sexo');
        $this->filterQuery($query, $queryParams, 'hobby');
        if (isset($queryParams['data_nascimento'])) {
            $query->whereRaw('DATE(data_nascimento) = DATE(\'' .
                Carbon::createFromTimestamp($queryParams['data_nascimento']) .
                '\')');
        }
        if (isset($queryParams['data_nascimento_menor']) && $queryParams['data_nascimento_menor'] > 0) {
            $query->where('data_nascimento_menor', '<',
                Carbon::createFromTimestamp($queryParams['data_nascimento_menor']));
        }
        if (isset($queryParams['data_nascimento_maior']) && $queryParams['data_nascimento_maior'] > 0) {
            $query->where('data_nascimento_maior', '>',
                Carbon::createFromTimestamp($queryParams['data_nascimento_maior']));
        }
        $this->orderBy($query, $queryParams, $orderBy, $columns);
        return $query->with('nivel')->paginate($queryParams['limit'] ?? 10);
    }

    public function delete(int $id): JsonResponse|Response
    {
        try {
            if (DesenvolvedorModel::destroy($id)) {
                return response()->noContent();
            }
        } catch (Exception $e) {
            return response(null, 400);
        }
        return response(null, 400);
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

    private function filterQuery(Builder $query, array|string $queryParams, string $column): void {
        if (isset($queryParams[$column])) {
            $query->where($column, 'like', '%' . $queryParams[$column] . '%');
        }
    }
}
