<?php

namespace App\Services;

class PasswordGenerator
{
    private array $symbols = ['!', '#', '$', '%', '&', '(', ')', '*', '+', '@', '^'];
    private string $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    private string $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private string $numbers = '0123456789';
    
    private bool $includeLowercase = true;
    private bool $includeUppercase = true;
    private bool $includeNumbers = true;
    private bool $includeSymbols = true;
    private int $minLength = 12;

    public function withLowercase(bool $include = true): self
    {
        $this->includeLowercase = $include;
        return $this;
    }

    public function withUppercase(bool $include = true): self
    {
        $this->includeUppercase = $include;
        return $this;
    }

    public function withNumbers(bool $include = true): self
    {
        $this->includeNumbers = $include;
        return $this;
    }

    public function withSymbols(bool $include = true): self
    {
        $this->includeSymbols = $include;
        return $this;
    }

    public function minLength(int $length): self
    {
        $this->minLength = max(1, $length);
        return $this;
    }

    public function generate(): string
    {
        $characters = '';
        $password = '';
        
        if ($this->includeLowercase) {
            $characters .= $this->lowercase;
            $password .= $this->lowercase[random_int(0, strlen($this->lowercase) - 1)];
        }
        
        if ($this->includeUppercase) {
            $characters .= $this->uppercase;
            $password .= $this->uppercase[random_int(0, strlen($this->uppercase) - 1)];
        }
        
        if ($this->includeNumbers) {
            $characters .= $this->numbers;
            $password .= $this->numbers[random_int(0, strlen($this->numbers) - 1)];
        }
        
        if ($this->includeSymbols) {
            $symbolString = implode('', $this->symbols);
            $characters .= $symbolString;
            $password .= $this->symbols[array_rand($this->symbols)];
        }
        
        if (empty($characters)) {
            throw new \InvalidArgumentException('At least one character type must be selected');
        }
        
        $remainingLength = $this->minLength - strlen($password);
        for ($i = 0; $i < $remainingLength; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }
        
        return str_shuffle($password);
    }
}