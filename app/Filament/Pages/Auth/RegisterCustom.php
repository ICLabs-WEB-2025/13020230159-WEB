<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Register;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RegisterCustom extends Register
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label('Nama')
            ->required()
            ->minLength(3)
            ->maxLength(50)
            ->autocomplete('name')
            ->extraInputAttributes(['tabindex' => 2]);
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Email')
            ->email()
            ->required()
            ->unique(User::class, 'email')
            ->autocomplete('email')
            ->extraInputAttributes(['tabindex' => 3]);
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Password')
            ->password()
            ->required()
            ->minLength(8)
            ->autocomplete('new-password')
            ->extraInputAttributes(['tabindex' => 4]);
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return TextInput::make('password_confirmation')
            ->label('Konfirmasi Password')
            ->password()
            ->required()
            ->same('password')
            ->autocomplete('new-password')
            ->extraInputAttributes(['tabindex' => 5]);
    }

    protected function getRememberFormComponent(): Component
    {
        return Checkbox::make('remember')
            ->label('Ingat saya')
            ->extraInputAttributes(['tabindex' => 6]);
    }

    protected function handleRegistration(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('asisten');

        return $user;

    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.nim' => 'NIM sudah terdaftar atau tidak valid.',
            'data.email' => 'Email sudah terdaftar atau tidak valid.',
            'data.password' => 'Password tidak valid.',
        ]);
    }
}
