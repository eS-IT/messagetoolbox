<?php declare(strict_types=1);
/**
 * @author      pfroch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2019
 * @license     EULA
 * @package     fememberadmin
 * @filesource  addMessage_dataProvider.php
 * @version     1.0.0
 * @since       04.07.19 - 18:14
 */

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