<?php

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
            return $userId;
            echo "пользователь $userId\n успешно создан";
        } else {
            print_r($user->LAST_ERROR);
            return false;
        }
    }

    public function GetUserIdByLogin($login) {

      $user = UserTable::getList([
          'select' => ['ID'],
          'filter' => ['LOGIN' => $login],
          'order' => ['ID' => 'DESC'],
      ]);
      return $user->fetch();
    }
    public function updateUserData(string $userId, array $fields): bool
    {
        $user = new CUser();
        $user->Update($userId, $fields);
        if (!empty ($user->LAST_ERROR)) {
            print_r($user->LAST_ERROR);
            return false;
        } else {
            "'$fields' изменено у";
            return true;
        }
    }
}