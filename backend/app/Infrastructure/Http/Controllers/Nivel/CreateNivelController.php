<?php

namespace App\Infrastructure\Http\Controllers\Nivel;

use App\Application\UseCases\Nivel\CreateNivelUseCase;
use App\Infrastructure\Models\NivelModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateNivelController
{
    private CreateNivelUseCase $createNivelUseCase;

    public function __construct(CreateNivelUseCase $createNivelUseCase) {
        $this->createNivelUseCase = $createNivelUseCase;
    }

    public function create(Request $request): NivelModel | JsonResponse
    {
        return $this->createNivelUseCase->handle($request);
    }
}