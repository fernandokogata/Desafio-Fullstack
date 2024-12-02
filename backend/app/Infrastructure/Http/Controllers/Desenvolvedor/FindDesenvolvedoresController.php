<?php

namespace App\Infrastructure\Http\Controllers\Desenvolvedor;

use App\Application\UseCases\Desenvolvedor\FindDesenvolvedoresUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FindDesenvolvedoresController
{
    private FindDesenvolvedoresUseCase $findDesenvolvedorUseCase;

    public function __construct(FindDesenvolvedoresUseCase $findDesenvolvedorUseCase)
    {
        $this->findDesenvolvedorUseCase = $findDesenvolvedorUseCase;
    }

    public function find(Request $request): array|Response
    {
        return $this->findDesenvolvedorUseCase->handle($request);
    }
}
