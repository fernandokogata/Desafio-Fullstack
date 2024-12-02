<?php

namespace App\Application\UseCases\Desenvolvedor;

use App\Domain\Entities\Desenvolvedor;
use App\Domain\Repositories\DesenvolvedorRepositoryInterface;
use App\Infrastructure\Models\DesenvolvedorModel;
use Carbon\Carbon;
use DateTimeImmutable;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CreateDesenvolvedorUseCase
{
    private DesenvolvedorRepositoryInterface $repository;

    public function __construct(DesenvolvedorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Request $request): DesenvolvedorModel|JsonResponse|Response
    {
        $validator = Validator::make($request->all(), [
            'id' => 'integer|nullable',
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
        $desenvolvedor->setNivelId($request->get('nivel_id'))
            ->setNome($request->get('nome'))
            ->setSexo($request->get('sexo'))
            ->setDataNascimento(Carbon::parse($request->get('data_nascimento')))
            ->setHobby($request->get('hobby'));
        return $this->repository->create($desenvolvedor);
    }
}
