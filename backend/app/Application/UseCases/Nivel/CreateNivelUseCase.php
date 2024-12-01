<?php

namespace App\Application\UseCases\Nivel;

use App\Domain\Entities\Nivel;
use App\Domain\Repositories\NivelRepositoryInterface;
use App\Infrastructure\Models\NivelModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateNivelUseCase
{
    private NivelRepositoryInterface $nivelRepository;

    public function __construct(NivelRepositoryInterface $nivelRepository)
    {
        $this->nivelRepository = $nivelRepository;
    }

    public function handle(Request $request): NivelModel|JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'integer|nullable',
            'nivel' => 'string|required',
        ]);

        if ($validator->fails()) {
            return response()->json($request, 400);
        }
        $nivel = new Nivel();
        $nivel->setNivel($request['nivel']);

        return $this->nivelRepository->create($nivel);
    }
}
