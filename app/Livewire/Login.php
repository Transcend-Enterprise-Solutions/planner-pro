<?php

namespace App\Livewire;

use Livewire\Component;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.authentication')]
#[Title('Plantilla Payroll')]
class Login extends Component
{
     public $email;
    public $password;
    public $showPassword = false;
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        $credentials = [
            Fortify::username() => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials, $this->remember)) {
            $user = Auth::user();

            if ($user->user_role === 'user') {
                return redirect()->intended('home');
            } else if (in_array($user->user_role, ['sa'])) {
                return redirect()->intended('dashboard');
            }
        } else {
            $this->addError('login', 'Invalid credentials.');
        }
    }


    public function render()
    {
        return view('livewire.login');
    }
}
