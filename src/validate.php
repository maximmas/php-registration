<?php

require_once(dirname(__DIR__) . '/vendor/autoload.php');

try {
    $_POST = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
    echo $e->getMessage();
}

if (!empty($_POST)) {

    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $password = htmlspecialchars($_POST['password']);
    $repeatPassword = htmlspecialchars($_POST['repeatPassword']);
    $email = htmlspecialchars($_POST['email']);

    $user = new \RegForm\UserRepository();
    $allUsers = $user->getAll();
    $validator = new \RegForm\Validator(
        email: $email,
        password: $password,
        repeatPassword: $repeatPassword,
    );

    $isEmail = $validator->isEmail();
    $isPassword = $validator->isPassword();
    $isUniqueEmail = !($allUsers) || $validator->isUniqueEmail($allUsers);

    if ($isUniqueEmail && $isPassword && $isEmail) {
        $isSaved = $user->save(
            $user->getNextUserID(),
            $firstName,
            $lastName,
            $email,
            password_hash($password, PASSWORD_DEFAULT));
        $response = [
            'registered' => is_numeric($isSaved),
            'errors' => []
        ];
    } else {
        $response = [
            'registered' => false,
            'errors' => [
                'pass' => $isPassword,
                'email' => $isEmail,
                'user' => $isUniqueEmail
            ]
        ];
    }

    echo json_encode($response, JSON_THROW_ON_ERROR);

    die(1);
}








