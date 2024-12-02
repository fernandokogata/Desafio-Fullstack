<?php

namespace App\Application\UseCases\Nivel;

use App\Domain\Entities\Nivel;
use App\Domain\Repositories\NivelRepositoryInterface;
use App\Infrastructure\Models\NivelModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CreateNivelUseCase
{
    private NivelRepositoryInterface $repository;

    public function __construct(NivelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Request $request): NivelModel|JsonResponse|Response
    {
        $validator = Validator::make($request->all(), [
            'id' => 'integer|nullable',
            'nivel' => 'string|required',
        ]);

        if ($validator->fails()) {
            return response(null, 400);
        }
        $nivel = new Nivel();
        $nivel->setNivel($request['nivel']);

        return $this->repository->create($nivel);
    }
}
