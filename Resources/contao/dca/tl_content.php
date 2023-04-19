<?php

/**
 * @package     Messagetoolbox
 * @since       14.11.19 - 11:18
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2019
 * @license     LGPL-3.0-or-later
 */

declare(strict_types=1);

/**
 * Set Tablename: tl_content
 */
$strName = 'tl_content';

/* Palettes */
$GLOBALS['TL_DCA'][$strName]['palettes']['cemassage'] = '{type_legend},type,headline;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop;';
