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

    public ?int $length = null;
    public array $includes = [];
    
    protected $rules = [
        'length'   => ['required', 'integer', 'min:4', 'max:30'],
        'includes' => ['required'],
    ];

    public function render(): Factory|View|Application
    {
        return view('livewire.form-password-generator');
    }

    public function mount(): void
    {
        $this->length   = 15;

        $this->includes = [
            'uppercase',
            'lowercase',
            'numbers',
            'symbols',
        ];
    }

    public function handle(): void
    {
        $this->validate();

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
