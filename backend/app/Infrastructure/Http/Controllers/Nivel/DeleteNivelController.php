<?php

namespace App\Infrastructure\Http\Controllers\Nivel;

use App\Application\UseCases\Nivel\CreateNivelUseCase;
use App\Application\UseCases\Nivel\DeleteNivelUseCase;
use App\Infrastructure\Models\NivelModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeleteNivelController
{
    private DeleteNivelUseCase $deleteNivelUseCase;

    public function __construct(DeleteNivelUseCase $deleteNivelUseCase)
    {
        $this->deleteNivelUseCase = $deleteNivelUseCase;
    }

    public function delete(int $id): JsonResponse|Response
    {
        return $this->deleteNivelUseCase->handle($id);
    }
}
