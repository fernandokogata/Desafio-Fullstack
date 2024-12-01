<?php

namespace App\Infrastructure\Http\Controllers\Nivel;

use App\Application\UseCases\Nivel\FindAllNiveisUseCase;
use Illuminate\Http\Request;

class FindAllNiveisController
{
    private FindAllNiveisUseCase $findAllNiveisUseCase;

    public function __construct(FindAllNiveisUseCase $findAllNiveisUseCase)
    {
        $this->findAllNiveisUseCase = $findAllNiveisUseCase;
    }

    public function findAll(Request $request): array
    {
        $queryParams = $request->query();
        return $this->findAllNiveisUseCase->handle($queryParams);
    }
}
