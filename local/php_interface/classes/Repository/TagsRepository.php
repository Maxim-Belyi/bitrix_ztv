<?php
namespace Local\Repository;
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
            
            $collection[] = new TagDTO(
                $fields["ID"], 
                $fields["VALUE"]
            );
        }
        return $collection;
    }
}