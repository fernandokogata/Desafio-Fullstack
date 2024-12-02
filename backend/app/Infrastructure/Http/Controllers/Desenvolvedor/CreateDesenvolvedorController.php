<?php

namespace App\Infrastructure\Http\Controllers\Desenvolvedor;

use App\Application\UseCases\Desenvolvedor\CreateDesenvolvedorUseCase;
use App\Infrastructure\Models\DesenvolvedorModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateDesenvolvedorController
{
    private CreateDesenvolvedorUseCase $createDesenvolvedorUseCase;

    public function __construct(CreateDesenvolvedorUseCase $createDesenvolvedorUseCase)
    {
        $this->createDesenvolvedorUseCase = $createDesenvolvedorUseCase;
    }

    public function create(Request $request): DesenvolvedorModel|JsonResponse|Response
    {
        return $this->createDesenvolvedorUseCase->handle($request);
    }
}
