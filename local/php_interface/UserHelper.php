<?php

use Bitrix\Main\UserTable;

class UserHelper
{
    public static function createNewUser(CreateUserDTO $dto): string
    {
        $user = new CUser;

        $arFields = [
            "LOGIN"             => $dto->login,
            "NAME"              => $dto->name,
            "LAST_NAME"         => $dto->lastName,
            "EMAIL"             => $dto->email,
            "PASSWORD"          => $dto->password,
            "CONFIRM_PASSWORD"  => $dto->password,
            "ACTIVE"            => $dto->isActive ? 'Y' : 'N',
            "UF_MY_STRING"      => $dto->myString,
            "UF_MY_NUMBER"      => $dto->myNumber,
            "UF_MY_BOOL"        => $dto->myBool ? 'Y' : 'N',
        ];

        $ID = $user->Add($arFields);
        
        if (intval($ID) > 0) {
            return "Пользователь {$dto->name} создан с ID: $ID";
        } else {
            return "Ошибка: $user->LAST_ERROR";
        }
    }

    
    public static function getList($filter = [], $order = ['ID' => 'ASC'])
    {
        $result = UserTable::getList([
            'select' => ['ID', 'NAME', 'ACTIVE', 'UF_*'],
            'filter' => $filter,
            'order' => $order,
        ]);
        return $result->fetchAll();
    }
    public static function updateByFilter($filter, $newFields): void
    {
        $usersList = self::getList($filter);
        $userObject = new CUser;
        foreach ($usersList as $newUserData) {
            $userId = $newUserData['ID'];
            $result = $userObject->Update($userId, $newFields);

            if (!$result) {
                echo "Что то пошло не так для пользователя {$userId}: " . $userObject->LAST_ERROR;
            }
        }
    }
    public static function deleteInactiveUser()
    {
        $filter = ["ACTIVE" => "N"];
        $users = self::getList($filter);
        $userObject = new CUser;
        foreach ($users as $userData) {
            $userObject->Delete($userData["ID"]);
            echo "Пользователь с ID: {$userData['ID']} был удален.<br>";
        }
    }
}
