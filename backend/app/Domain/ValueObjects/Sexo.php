<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use DomainException;

class Sexo
{
    private string $sexo;
    public function __construct(string $sexo) {
        if(!in_array($sexo, ['M', 'F'])) {
            throw new DomainException('Campo sexo deve ser M ou F.');
        }
        $this->sexo = $sexo;
    }

    public function __toString(): string {
        return $this->sexo;
    }
}
