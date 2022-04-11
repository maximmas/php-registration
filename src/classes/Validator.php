<?php

namespace RegForm;

class Validator
{

    public function __construct(
        private string $email,
        private string $password,
        private string $repeatPassword,
    )
    {
    }


    public function isEmail(): string|false
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }


    public function isPassword(): bool
    {
        return $this->password === $this->repeatPassword;
    }


    public function isUniqueEmail(array $allUsers): bool
    {

        if ($allUsers) {
            foreach ($allUsers as $user) {
                if ($user['email'] === $this->email) {
                    return false;
                }
            }
        }
        return true;
    }


}