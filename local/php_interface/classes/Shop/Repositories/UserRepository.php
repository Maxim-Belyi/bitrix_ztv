<?php

// use Bitrix\Landing\Controller\User;
use Bitrix\Main\UserTable;

class UserRepository
{
    public function getUserById(string $userId): ?array
    {
        $user = UserTable::getById($userId)->fetch();
        return $user;
    }

    public function createUser(array $fields)
    {
        $user = new CUser();
        $userId = $user->Add($fields);
        if ($userId) {
            echo "пользователь '$userId' успешно создан";
            return $userId;
        } else {
            print_r($user->LAST_ERROR);
            return false;
        }
    }

    public function deleteUser(string $userId): bool
    {
        $user = UserTable::getById($userId)->fetch();
        $user = new CUser();
        $user->Delete($userId);
        if (empty($user->LAST_ERROR)) {
            print_r($user->LAST_ERROR);
            return false;
        }
        return true;
    }
    public function GetUserIdByLogin($login)
    {
        $user = UserTable::getList([
            'select' => ['ID'],
            'filter' => ['LOGIN' => $login],
            'order' => ['ID' => 'DESC'],
        ]);
        return $user->fetch();
    }
    public function updateUserData(string $userId, ?array $fields): bool
    {
        $user = new CUser();
        $user->Update($userId, $fields);
        if (!empty($user->LAST_ERROR)) {
            print_r($user->LAST_ERROR);
            return false;
        } else {
            "$fields изменено";
            return true;
        }
    }

    public function getUsersList(): ?array
    {
        $usersList = UserTable::getList([
            'select' => ["ID", "LOGIN", "EMAIL", "NAME", "LAST_NAME", "UF_CAT_NAME"],
            'filter' => ["ACTIVE" => "Y"],
            "order" => ["NAME" => "ASC"],
        ])->fetchALL();
        return $usersList;
    }
}
