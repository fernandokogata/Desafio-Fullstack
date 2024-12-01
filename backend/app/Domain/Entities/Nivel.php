<?php

declare(strict_types=1);

namespace App\Domain\Entities;

class Nivel
{
    private int|null $id;
    private string $nivel;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int|null $id): Nivel
    {
        $this->id = $id;
        return $this;
    }

    public function getNivel(): string
    {
        return $this->nivel;
    }

    public function setNivel(string $nivel): Nivel
    {
        $this->nivel = $nivel;
        return $this;
    }

    public function value(): array
    {
        return [
            'id' => $this->id ?? null,
            'nivel' => $this->nivel
        ];
    }
}
