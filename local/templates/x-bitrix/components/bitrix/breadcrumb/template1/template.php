<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(empty($arResult))
	return "";

$strReturn = '<div class="breadcrumbs">';

$itemSize = count($arResult);

for($index = 0; $index < $itemSize; $index++)
{
	$title = $arResult[$index]["TITLE"];
	$link = $arResult[$index]["LINK"];
    
	if($arResult[$index]["LINK"] != "" && $index != $itemSize-1)
	{
		$strReturn .= '<a href="'.$link.'"class="breadcrumbs-item">' . $title . ' /&nbsp '.'</a>';
	}
	else
	{
		$strReturn .= '<div class="breadcrumbs-item">'.$title.'</div>';
	}
}

$strReturn .= '</div>';

return $strReturn;

