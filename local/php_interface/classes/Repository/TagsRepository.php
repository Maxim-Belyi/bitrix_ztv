<?php
use Local\Dto\tagDto;
use \CIBlockPropertyEnum;

class TagsRepository
{
    public static function getTagsCollection(int $iblockId): array {
        $collection = [];
        $propertyEnums = CIBlockPropertyEnum::GetList(
            ["SORT" => "ASC", "VALUE" => "ASC"],
            ["IBLOCK_ID"=> $iblockId, "CODE" => "tags"]
        );

        while ($fields = $propertyEnums->Fetch()) {
            $collection[] = new TagDTO((int) $fields["ID"], (int) $fields["VALUE"]);
        }
        return $collection;
    }
}