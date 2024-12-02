<?php

namespace App\Infrastructure\Http\Controllers\Desenvolvedor;

use App\Application\UseCases\Desenvolvedor\DeleteDesenvolvedorUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DeleteDesenvolvedorController
{
    private DeleteDesenvolvedorUseCase $deleteDesenvolvedorUseCase;

    public function __construct(DeleteDesenvolvedorUseCase $deleteDesenvolvedorUseCase)
    {
        $this->deleteDesenvolvedorUseCase = $deleteDesenvolvedorUseCase;
    }

    public function delete(int $id): JsonResponse|Response
    {
        return $this->deleteDesenvolvedorUseCase->handle($id);
    }
}
