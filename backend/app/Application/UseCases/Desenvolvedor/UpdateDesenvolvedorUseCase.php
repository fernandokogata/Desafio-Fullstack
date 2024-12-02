<?php

namespace App\Application\UseCases\Desenvolvedor;

use App\Domain\Entities\Desenvolvedor;
use App\Domain\Repositories\DesenvolvedorRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UpdateDesenvolvedorUseCase
{
    private DesenvolvedorRepositoryInterface $repository;

    public function __construct(DesenvolvedorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Request $request): JsonResponse|Response
    {
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'nivel_id' => 'integer|exists:niveis,id',
            'nome' => 'string|required',
            'sexo' => 'string|required|in:M,F',
            'data_nascimento' => 'date|required',
            'hobby' => 'string|required'
        ]);

        try {
            if ($validator->fails()) {
                return response(null, 400);
            }
        } catch (Exception $e) {
            return response(null, 400);
        }

        $desenvolvedor = new Desenvolvedor();
        $desenvolvedor->setId($request->get('id'))
            ->setNivelId($request->get('nivel_id'))
            ->setNome($request->get('nome'))
            ->setSexo($request->get('sexo'))
            ->setDataNascimento(Carbon::parse($request->get('data_nascimento')))
            ->setHobby($request->get('hobby'));
        return $this->repository->update($desenvolvedor);
    }
}
