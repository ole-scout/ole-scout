<?php

namespace FossHaas\Auth\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;

class LoginForm extends Form
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;
}
