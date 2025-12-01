<?php

\Bitrix\Main\Loader::includeModule('iblock');

use Bitrix\Main\ORM\Fields\ExpressionField;

use Bitrix\Iblock\Elements\ElementPromotionsTable;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

class PromotionHelper
{
    public static function getList($filter = [])
    {
        $dbItems = ElementPromotionsTable::getList([
            'select' => [
                'ID',
                'NAME',
                'DISCOUNT_VAL' => 'ATT_DISCOUNT.VALUE',
                'DATE_VAL' => 'ATT_DATE.VALUE',
                'CITY_VAL' => 'ATT_CITY.VALUE',
                'USER_NAME' => 'MODIFIED_BY_USER.NAME',
                'USER_LAST_NAME' => 'MODIFIED_BY_USER.LAST_NAME',
            ],
            'filter' => $filter,
            'order' => ['ID' => 'ASC'],
        ]);
        $result = [];

        while ($row = $dbItems->fetch()) {
            $id = $row['ID'];
            $dateFormatted = '';
            if ($row['DATE_VAL'] instanceof \Bitrix\Main\Type\Date) {
                $dateFormatted = $row['DATE_VAL']->format('d.m.Y');
            }

            if (!isset($result[$id])) {
                $result[$id] = [
                    'ID' => $row['ID'],
                    'NAME' => $row['NAME'],
                    'DISCOUNT' => (float)$row['DISCOUNT_VAL'],
                    'START_DATE' => $dateFormatted,
                    'MODIFIED_BY_FIO' => $row['USER_NAME'] . ' ' . $row['USER_LAST_NAME'],
                    'CITIES' => []
                ];
            }
            if (!empty($row['CITY_VAL'])) {
                $result[$id]['CITIES'][]= $row['CITY_VAL'];
            }
        }
        return array_values($result);
    }

    public static function getDiscountStats(): mixed
    {
        $query = ElementPromotionsTable::query();

        $query->addSelect(new ExpressionField('MIN_DISCOUNT', 'MIN(%s)', 'ATT_DISCOUNT.VALUE'));
        $query->addSelect(new ExpressionField('MAX_DISCOUNT', 'MAX(%s)', 'ATT_DISCOUNT.VALUE'));
        $query->addSelect(new ExpressionField('AVG_DISCOUNT', 'AVG(%s)', 'ATT_DISCOUNT.VALUE'));

        $query->where('ATT_DISCOUNT.VALUE', '>', 0);
        $stats = $query->exec()->fetch();
        return $stats;
    }
}
