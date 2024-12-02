<?php

namespace App\Application\UseCases\Nivel;

use App\Domain\Entities\Nivel;
use App\Domain\Repositories\NivelRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UpdateNivelUseCase
{
    private NivelRepositoryInterface $repository;

    public function __construct(NivelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Request $request): JsonResponse|Response
    {
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'nivel' => 'string|required',
        ]);

        if ($validator->fails()) {
            return response(null, 400);
        }

        $nivel = new Nivel();
        $nivel->setId($request->get('id'));
        $nivel->setNivel($request->get('nivel'));
        return $this->repository->update($nivel);
    }
}
