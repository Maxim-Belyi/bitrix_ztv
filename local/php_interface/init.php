<?php
use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(
    null,
     [
        'Local\Dto\TagDto' => '/local/php_interface/classes/Dto/TagDto.php',
        'Local\Repository\TagsRepository' => '/local/php_interface/classes/Repository/TagsRepository.php',
    ]
);