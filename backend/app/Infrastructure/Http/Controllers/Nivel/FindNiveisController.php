<?php

namespace App\Infrastructure\Http\Controllers\Nivel;

use App\Application\UseCases\Nivel\FindNiveisUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FindNiveisController
{
    private FindNiveisUseCase $findNiveisUseCase;

    public function __construct(FindNiveisUseCase $findNiveisUseCase)
    {
        $this->findNiveisUseCase = $findNiveisUseCase;
    }

    public function find(Request $request): array|Response
    {
        $queryParams = $request->query();
        return $this->findNiveisUseCase->handle($queryParams);
    }
}
