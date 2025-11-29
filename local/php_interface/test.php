<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
require($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/classes/Shop/Repositories/UserRepository.php');

$adminId = 1;
$UserRepository = new UserRepository();
$adminInfo = $UserRepository->getUserById($adminId);

$fieldsUser1 = [
    "NAME" => "Василий",
    "LAST_NAME" => "Пупкин",
    "EMAIL" => "vasiliypupkin@gmail.com",
    "LOGIN" => "vasiliypupkin",
    "LID" => "ru",
    "ACTIVE" => "Y",
    "PASSWORD" => "123456",
    "CONFIRM_PASSWORD" => "123456",
];

$fieldsUser2 = [
    "NAME" => "Инокентий",
    "LAST_NAME" => "Птичкин",
    "EMAIL" => "keshaptichkin@gmail.com",
    "LOGIN" => "keshaptichkin",
    "LID" => "ru",
    "ACTIVE" => "Y",
    "PASSWORD" => "555444",
    "CONFIRM_PASSWORD" => "555444",
    "UF_CAT_NAME" => "Царапка"
];

$fieldsUser3 = [
    "NAME" => "Встанислав",
    "LAST_NAME" => "Шишкин",
    "EMAIL" => "vstan@gmail.com",
    "LOGIN" => "shishkin",
    "LID" => "ru",
    "ACTIVE" => "Y",
    "PASSWORD" => "555444",
    "CONFIRM_PASSWORD" => "555444",
    "UF_CAT_NAME" => "Корица"
];

$vasilyiInfo = $UserRepository->GetUserIdByLogin("vasiliypupkin");
echo "<pre>";
print_r($vasilyiInfo);
echo "<pre>";

if(!empty($vasilyiInfo)){
    $fieldsUser1 = [
        "UF_CAT_NAME" => "Светлана",
    ];
    $UserRepository->updateUserData($vasilyiInfo['ID'], $fieldsUser1);
}


$loginToFind = $fieldsUser1["LOGIN"];
$userID = $UserRepository->GetUserIdByLogin($loginToFind);
if ($userID) {
    $fieldsToUpdate = [
        "UF_CAT_NAME" => "Светлана"
    ];
} else {
    echo "Пользователь с логином '$loginToFind' не найден";
}

//$UserRepository->createUser($fieldsUser1);

echo "<pre>";
print_r($adminInfo);
echo "<pre>";