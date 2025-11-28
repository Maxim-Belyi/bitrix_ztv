<?php
require($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/userHelper.php");

$newUserFields = [
    "LOGIN" => "test_user1",
    "NAME" => "иван",
    "LAST_NAME" => "факов",
    "PASSWORD" => "123456",
    "CONFIRM_PASSWORD" => "123456",
    "EMAIL" => "test@test.ru",
    "ACTIVE" => "Y",
    "UF_MY_STRING" => "какая то строка",
    "UF_MY_NUMBER" => 1443239994,
    "UF_MY_BOOL" => TRUE,
];

echo UserHelper::createNewUser($newUserFields);
echo "<pre>";
print_r(UserHelper::getList());
echo "</pre>"
?>;