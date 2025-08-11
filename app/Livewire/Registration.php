<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.authentication')]
#[Title('Register')]
class Registration extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public function register()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|string|same:password',
        ]);

        try {
            $user = User::create([
                'name' => trim($this->name),
                'email' => strtolower(trim($this->email)),
                'password' => Hash::make($this->password),
                'user_role' => 'user',
                'active_status' => 0,
                'profile_photo_path' => null,
            ]);

            $this->name = '';
            $this->email = '';
            $this->password = '';
            $this->password_confirmation = '';

            return $this->redirect('/login');

        } catch (\Exception $e) {
            $this->addError('registration', 'An error occurred while creating your account. Please try again.');
            Log::error('Registration error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.registration');
    }
}
