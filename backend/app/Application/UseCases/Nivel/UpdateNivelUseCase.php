<?php

namespace App\Application\UseCases\Nivel;

use App\Domain\Entities\Nivel;
use App\Domain\Repositories\NivelRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateNivelUseCase
{
    private NivelRepositoryInterface $nivelRepository;

    public function __construct(NivelRepositoryInterface $nivelRepository)
    {
        $this->nivelRepository = $nivelRepository;
    }

    public function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'nivel' => 'string|required',
        ]);

        if ($validator->fails()) {
            return response()->json($request, 400);
        }

        $nivel = new Nivel();
        $nivel->setId($request->get('id'));
        $nivel->setNivel($request->get('nivel'));
        return $this->nivelRepository->update($nivel);
    }
}
