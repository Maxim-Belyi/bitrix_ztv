<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

global $arrFilter;
$arrFilter = array();

if ($_GET['filter'] == 'Y') {
	if (!empty($_GET['date_start'])) {
		$stmp = MakeTimeStamp($_GET['date_start'], "YYYY-MM-DD");
		$arrFilter['>=DATE_ACTIVE_FROM'] = date("d.m.Y", $stmp);
	}
	if (!empty($_GET['tag_id'])) {
		$arrFilter['PROPERTY_tags'] = $_GET['tag_id'];
	}
}
?>


<section class="all-news">
	<div class="wrapper">
		<h2>Все новости</h2>

		<div class="breadcrumbs">
			<div class="breadcrumbs-item">Главная</div>
			<div class="breadcrumbs-item">Новости</div>
		</div>

		<form action="" method="get" class="all-news__controls fadeInUp">
			<input type="hidden" name="filter" value="Y">

			<div class="all-news__controls-date">

				<input class="datepicker-here" type="text" name="date_start" id="news-datepicker" data-range="true"
					data-toggle-selected="false" placeholder=""
					value="<?= htmlspecialcharsbx($_GET['date_start']) ?>">
			</div>

			<div class="all-news__controls-rubric">
				<div class="select-box all-news__controls-rubric-select">

					<div class="select-box__current" tabindex="1">

						<?php if (!empty($arResult["TAGS_LIST"])): ?>
							<?php foreach ($arResult["TAGS_LIST"] as $tag): ?>
								<div class="select-box__value">
									<input class="select-box__input" type="radio" id="tag_<?= $tag['ID'] ?>"
										value="<?= $tag['ID'] ?>" name="tag_id" <?php if ($_GET['tag_id'] == $tag['ID'])
											  echo 'checked'; ?>>
									<p class="select-box__input-text"><?= $tag['VALUE'] ?></p>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>

					<ul class="select-box__list">

						<?php if (!empty($arResult["TAGS_LIST"])): ?>
							<?php foreach ($arResult["TAGS_LIST"] as $tag): ?>
								<li>
									<label class="select-box__option" for="tag_<?= $tag['ID'] ?>" aria-hidden>
										<?= $tag['VALUE'] ?>
									</label>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
			</div>

			<button type="submit" class="all-news__controls-submit">
				Показать
			</button>

		</form>
	</div>

	<?php
	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		".default",
		[
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NEWS_COUNT" => $arParams["NEWS_COUNT"],
			"SORT_BY1" => $arParams["SORT_BY1"],
			"SORT_ORDER1" => $arParams["SORT_ORDER1"],
			"SORT_BY2" => $arParams["SORT_BY2"],
			"SORT_ORDER2" => $arParams["SORT_ORDER2"],
			"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
			"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
			"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
			"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
			"IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
			"MESSAGE_404" => $arParams["MESSAGE_404"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"SHOW_404" => $arParams["SHOW_404"],
			"FILE_404" => $arParams["FILE_404"],
			"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
			"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
			"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
			"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
			"CHECK_DATES" => $arParams["CHECK_DATES"],
		],
		$component
	);
	?>

	</div>
</section>