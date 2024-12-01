<?php

namespace App\Infrastructure\Http\Controllers\Nivel;

use App\Application\UseCases\Nivel\UpdateNivelUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateNivelController
{
    private UpdateNivelUseCase $updateNivelUseCase;

    public function __construct(UpdateNivelUseCase $updateNivelUseCase)
    {
        $this->updateNivelUseCase = $updateNivelUseCase;
    }

    public function update(Request $request): JsonResponse
    {
        return $this->updateNivelUseCase->handle($request);
    }
}
