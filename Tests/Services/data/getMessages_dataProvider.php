<?php

/**
 * @package     Messagetoolbox
 * @since       04.07.19 - 17:44
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2019
 * @license     LGPL-3.0-or-later
 */

declare(strict_types=1);

return [
    'emptyTest' => [
        '$messages' => []
    ],
    'oneTest' => [
        '$messages' => ['Test']
    ],
    'twoTest' => [
        '$messages' => ['Test', 'Noch einer']
    ]
];