<?php

namespace App\Infrastructure\Http\Controllers\Desenvolvedor;

use App\Application\UseCases\Desenvolvedor\UpdateDesenvolvedorUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UpdateDesenvolvedorController
{
    private UpdateDesenvolvedorUseCase $updateDesenvolvedorUseCase;

    public function __construct(UpdateDesenvolvedorUseCase $updateDesenvolvedorUseCase)
    {
        $this->updateDesenvolvedorUseCase = $updateDesenvolvedorUseCase;
    }

    public function update(Request $request): JsonResponse|Response
    {
        return $this->updateDesenvolvedorUseCase->handle($request);
    }
}
