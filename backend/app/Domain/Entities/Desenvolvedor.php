<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use DateTimeInterface;
use Illuminate\Support\Facades\Date;

class Desenvolvedor
{
    private int $id;
    private int $nivel_id;
    private string $nome;
    private string $sexo;
    private DateTimeInterface $data_nascimento;
    private string $hobby;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Desenvolvedor
    {
        $this->id = $id;
        return $this;
    }

    public function getNivelId(): int
    {
        return $this->nivel_id;
    }

    public function setNivelId(int $nivel_id): Desenvolvedor
    {
        $this->nivel_id = $nivel_id;
        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): Desenvolvedor
    {
        $this->nome = $nome;
        return $this;
    }

    public function getSexo(): string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): Desenvolvedor
    {
        $this->sexo = $sexo;
        return $this;
    }

    public function getDataNascimento(): DateTimeInterface
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento(DateTimeInterface $data_nascimento): Desenvolvedor
    {
        $this->data_nascimento = $data_nascimento;
        return $this;
    }

    public function getHobby(): string
    {
        return $this->hobby;
    }

    public function setHobby(string $hobby): Desenvolvedor
    {
        $this->hobby = $hobby;
        return $this;
    }

    public function value(): array
    {
        return [
            'id' => $this->id ?? null,
            'nivel_id' => $this->nivel_id,
            'nome' => $this->nome,
            'sexo' => $this->sexo,
            'data_nascimento' => $this->data_nascimento,
            'hobby' => $this->hobby,
        ];
    }
}
