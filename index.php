<?php
global $APPLICATION;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/UserHelper.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/CreateUserDTO.php");

$APPLICATION->SetTitle("ZTV");
?>
<?php

// $userData1 = [
//     "LOGIN" => "petr228",
//     "PASSWORD" => "123456",
//     "CONFIRM_PASSWORD" => "123456",
//     "EMAIL" => "petr@gmail.com",

//     "NAME" => "Пётр",
//     "LAST_NAME" => "Познер",
//     "ACTIVE" => "Y",

//     "UF_MY_STRING" => "Погромист",
//     "UF_MY_NUMBER" => 25,
//     "UF_MY_BOOL" => 1,
// ];

// $userData2 = [
//     "LOGIN" => "oksana13",
//     "PASSWORD" => "222333444",
//     "CONFIRM_PASSWORD" => "222333444",
//     "EMAIL" => "poshlaya@gmail.com",

//     "NAME" => "Оксана",
//     "LAST_NAME" => "Поляшова",
//     "ACTIVE" => "Y",

//     "UF_MY_STRING" => "Дизайнер",
//     "UF_MY_NUMBER" => 22,
//     "UF_MY_BOOL" => 1,
// ];

// $userData3 = [
//     "LOGIN" => "olga12",
//     "PASSWORD" => "122322",
//     "CONFIRM_PASSWORD" => "122322",
//     "EMAIL" => "olga@gmail.com",

//     "NAME" => "Ольга",
//     "LAST_NAME" => "Курникова",
//     "ACTIVE" => "Y",

//     "UF_MY_STRING" => "Барбер",
//     "UF_MY_NUMBER" => 31,
//     "UF_MY_BOOL" => 0,
// ];


//добавляем
$userDto = new CreateUserDTO(
    login: "DtoUser1",
    name: "Дтослав",
    lastName: "Дтославович",
    email: "Dto@gmail.com",
    password: "123456",
    isActive: true,
    myString: "погромист",
    myNumber: 22,
    myBool: true,
);

$vladimir = new CreateUserDTO(
    login: "Vladimir122",
    name: "Владимир",
    lastName: "Иванов",
    email: "vlad@gmail.com",
    password: "12345678",
    isActive: true,
    myString: "сапожник",
    myNumber: 122,
    myBool: true,
);

echo UserHelper::createNewUser(dto: $userDto);
echo '<br>';
echo UserHelper::createNewUser(dto: $vladimir);

//сортируем по имени
$allUsers = UserHelper::getList(
    [],
    ["NAME" => "ASC"]
);

//Обновляем у кого uf_my_bool true
$filterTask = ['UF_MY_BOOL' => 1];

$fieldTask = [
    'UF_MY_STRING'=> 'Блогер',
];

UserHelper::updateByFilter($filterTask, $fieldTask);

//удаляем пользователей у которых число больше заданного
$fiterTask6 = ['>UF_MY_NUMBER' => 50];
$fieldTask6 = ['ACTIVE' => 'N'];
UserHelper::updateByFilter($fiterTask6, $fieldTask6);

//выбирем пользователей с построкой
$filterTask7 = [
    'ACTIVE'=> 'Y',
    '%UF_MY_STRING' => 'тест',
];

$users = UserHelper::getList($filterTask7);

if (!empty($users)) {
    echo "Найдено " . count($users);
} else {
    echo "С такой подстрокой никого не нашли";
}
 
//удаляем неактивных (неугодных)
UserHelper::deleteInactiveUser();
print "Неактивные пользователи удалены"

// echo "<pre>";
// print_r($allUsers);
// echo "</pre>";

?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>