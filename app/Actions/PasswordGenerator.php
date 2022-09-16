<?php

namespace App\Actions;

class PasswordGenerator
{
    private int $length;
    private bool $includeUppercase;
    private bool $includeLowercase;
    private bool $includeNumbers;
    private bool $includeSymbols;

    public function __construct(int $length, bool $includeUppercase, bool $includeLowercase, bool $includeNumbers, bool $includeSymbols)
    {
        $this->length           = $length;
        $this->includeUppercase = $includeUppercase;
        $this->includeLowercase = $includeLowercase;
        $this->includeNumbers   = $includeNumbers;
        $this->includeSymbols   = $includeSymbols;
    }

    public function handle(): string
    {
        $positions = $this->getPositions();
        $password  = '';

        for ($i = 0; $i < $this->length; $i++) {
            $position   = $positions[$i];
            $characters = $this->getCharacters($position);
            $password .= $characters[random_int(0, sizeof($characters) - 1)];
        }

        return $password;
    }

    private function getCharacters(string $position): array
    {
        switch ($position) {
            case 'uppercase':
                return $this->getUppercaseCharacters();
            case 'lowercase':
                return $this->getLowercaseCharacters();
            case 'number':
                return $this->getNumberCharacters();
            case 'symbol':
                return $this->getSymbolCharacters();
            case 'all':
            default:
                return $this->getAllCharacters();
        }
    }

    private function getAllCharacters(): array
    {
        $characters = [];

        if ($this->includeUppercase) {
            $characters = array_merge($characters, $this->getUppercaseCharacters());
        }

        if ($this->includeLowercase) {
            $characters = array_merge($characters, $this->getLowercaseCharacters());
        }

        if ($this->includeNumbers) {
            $characters = array_merge($characters, $this->getNumberCharacters());
        }

        if ($this->includeSymbols) {
            $characters = array_merge($characters, $this->getSymbolCharacters());
        }

        return $characters;
    }

    private function getUppercaseCharacters(): array
    {
        return range('A', 'Z');
    }

    private function getLowercaseCharacters(): array
    {
        return range('a', 'z');
    }

    private function getNumberCharacters(): array
    {
        return range(0, 9);
    }

    private function getSymbolCharacters(): array
    {
        return ['!', '@', '$', '%', '^', '&' , '*', '(' , ')', '<', '>'];
    }

    private function getPositions(): array
    {
        $positions = [];

        if ($this->includeUppercase) {
            $positions[] = 'uppercase';
        }

        if ($this->includeLowercase) {
            $positions[] = 'lowercase';
        }

        if ($this->includeNumbers) {
            $positions[] = 'number';
        }

        if ($this->includeSymbols) {
            $positions[] = 'symbol';
        }

        while (sizeof($positions) < $this->length) {
            $positions[] = 'all';
        }

        shuffle($positions);

        return $positions;
    }
}
