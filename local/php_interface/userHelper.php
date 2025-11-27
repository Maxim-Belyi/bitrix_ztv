<?php

use Bitrix\Main\UserTable;
class userHelper
{
    public static function createNewUser($fields):string
    {
        $user = new CUser;
        $ID = $user->Add($fields);
        if (intval($ID) > 0) {
            return "Пользователь создан с ID: " . $ID;
        } else {
            return "Ошибка: " . $user->LAST_ERROR;
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
        return [];
    }
    public static function updateByFilter($filter, $newFields):void
    {
        $usersList = self::getList($filter);
        $userObject = new CUser;
        foreach ($usersList as $newUserData) {
            $userId = $newUserData['ID'];
            $result = $userObject->Update($userId, $newFields);

            if (!$result) {
                echo "Что то пошло не так для пользователя $userId: " . $userObject->LAST_ERROR->LAST_ERROR;
            }
        }
    }
    public static function deleteInactiveUser()
    {

    }
}