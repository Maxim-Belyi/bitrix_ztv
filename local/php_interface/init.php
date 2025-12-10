<?php
use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(
    null,
    [
        "Local\Dto\TagDTO" => __DIR__ . "/local/php_interface/classes/Dto/TagDto.php",
        "Local\Repository\TagsRepository" => __DIR__ . "/local/php_interface/classes/Repository/TagsRepository.php"
    ]
);