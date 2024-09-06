<?php

namespace FossHaas\Auth\Livewire;

use FossHaas\Auth\Actions\Authenticate;
use FossHaas\Auth\Exceptions\AuthenticationFailure;
use FossHaas\Auth\Livewire\Forms\LoginForm;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Authentication extends Component
{
    public LoginForm $loginForm;

    public function login(Authenticate $authenticate): void
    {
        $this->validate();

        try {
            $authenticate->handle(
                $this->loginForm->except(['remember']),
                $this->loginForm->remember
            );
        } catch (AuthenticationFailure $exception) {
            throw ValidationException::withMessages([
                'loginForm.email' => $exception->getMessage(),
            ]);
        }
        $this->redirectIntended();
    }

    public function render(): View
    {
        return view('auth::authentication');
    }
}
