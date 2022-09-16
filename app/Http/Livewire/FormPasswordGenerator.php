<?php

namespace App\Http\Livewire;

use App\Actions\PasswordGenerator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Olssonm\Zxcvbn\Facades\Zxcvbn;

class FormPasswordGenerator extends Component
{
    public string $password;
    public int $passwordScore;

    public ?int $length    = 24;
    public array $includes = [];

    public function render(): Factory|View|Application
    {
        return view('livewire.form-password-generator');
    }

    public function mount(): void
    {
        $this->includes = [
            'uppercase',
            'lowercase',
            'numbers',
            'symbols',
        ];
    }

    public function handle(): void
    {
        $this->validate([
            'length'   => ['required', 'integer', 'min:0', 'max:256'],
            'includes' => ['required'],
        ]);

        $generator = new PasswordGenerator(
            $this->length,
            in_array('uppercase', $this->includes),
            in_array('lowercase', $this->includes),
            in_array('numbers', $this->includes),
            in_array('symbols', $this->includes)
        );
        $this->password = $generator->handle();
        
        $passwordStrength    = Zxcvbn::passwordStrength($this->password);
        $this->passwordScore = $passwordStrength['score'] + 1;
    }
}
