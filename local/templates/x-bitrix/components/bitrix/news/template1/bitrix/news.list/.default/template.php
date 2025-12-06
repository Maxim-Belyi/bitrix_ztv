<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
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
?>

<section class="all-news">
	<div class="wrapper">
		<div class="all-news__cards cards">

			<?php foreach ($arResult["ITEMS"] as $arItem): ?>

				<div class="all-news__card cards__item fadeInUp" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">

					<?php if (!empty($arItem["PREVIEW_PICTURE"]["SRC"])): ?>
						<div class="cards__item-img">
							<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>">
						</div>
					<?php endif; ?>

					<div class="cards__item-content">
						<div class="cards__item-top">

							<?php if (!empty($arItem["DISPLAY_PROPERTIES"]["tags"]["DISPLAY_VALUE"])): ?>
								<?php
								$tags = $arItem["DISPLAY_PROPERTIES"]["tags"]["DISPLAY_VALUE"];
								if (!is_array($tags)) {
									$tags = array($tags);
								}
								?>
								<?php foreach ($tags as $tag): ?>
									<p><?= $tag ?></p>
								<?php endforeach; ?>
							<?php endif; ?>

							<span><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></span>
						</div>

						<div class="cards__item-text">
							<?= $arItem["NAME"] ?>
						</div>
					</div>

					<div href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="cards__item-link"></div>
				</div>

			<?php endforeach; ?>

		</div>

		<?php if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
			<div class="pagination-wrapper"> 
				<?= $arResult["NAV_STRING"] ?>
			</div>
		<?php endif; ?>

	</div>
</section>
