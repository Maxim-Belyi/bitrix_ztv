<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<nav class="header__nav">
    <?php
    $previousLevel = 0; foreach ($arResult as $item):
    ?>

    <?php if ($previousLevel && $item["DEPTH_LEVEL"] < $previousLevel): ?>
        <?= str_repeat("</ul></div>", ($previousLevel - $item["DEPTH_LEVEL"])); ?>
    <?php endif ?>

    <?php if ($item["IS_PARENT"]): ?>

    <?php if ($item["DEPTH_LEVEL"] == 1): ?>
    <div class="header__nav-item openable">
        <span><?= $item["TEXT"] ?></span>
        <ul>
            <?php else: ?>
            <li>
                <a href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a>
                <ul>
                    <?php endif ?>

                    <?php else: ?>

                        <?php if ($item["PERMISSION"] > "D"): ?>
                            <?php if ($item["DEPTH_LEVEL"] == 1): ?>
                                <a class="header__nav-item" href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a>
                            <?php else: ?>
                                <li><a href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a></li>
                            <?php endif ?>
                        <?php endif ?>

                    <?php endif ?>
                    <?php $previousLevel = $item["DEPTH_LEVEL"]; ?>
                    <?php endforeach ?>
                    <?php if ($previousLevel > 1): ?>
                        <?= str_repeat("</ul></div>", ($previousLevel - 1)); ?>
                    <?php endif ?>
                </ul>
            </li>
        </ul>
</nav>


