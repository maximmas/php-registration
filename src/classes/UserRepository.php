<?php

namespace RegForm;

class UserRepository
{

    private string $logFile;


    public function __construct()
    {
        $this->logFile = $_SERVER['DOCUMENT_ROOT'] . '/log/users.log';
    }


    public function save(
        string $userId,
        string $firstName,
        string $lastName,
        string $email,
        string $password
    ): int|false
    {
        $data = [
            'id' => $userId,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => $password
        ];

        try {
            $handle = fopen($this->logFile, 'a+');
            $result = fwrite($handle, json_encode($data, JSON_THROW_ON_ERROR) . PHP_EOL);
            fclose($handle);
        } catch (\Exception $e) {
            echo "Saving log file error: " . $e->getMessage();
        }

        return $result;
    }


    public function getAll(): array
    {
        $users = [];
        $handle = fopen($this->logFile, 'rb');
        if ($handle) {
            while (!feof($handle)) {
                $user = fgets($handle);
                if ($user) {
                    $users[] = json_decode($user, true, 512, JSON_THROW_ON_ERROR);
                }

            }
            fclose($handle);
        }
        return $users;
    }


    public function getNextUserID(): int
    {
        $counter = 0;
        $handle = fopen($this->logFile, 'rb');
        if ($handle) {
            while (!feof($handle)) {
                fgets($handle);
                ++$counter;
            }
            fclose($handle);

        }
        return $counter;
    }

}