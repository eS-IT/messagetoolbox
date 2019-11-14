<?php
/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 *
 * @package     Messagetoolbox
 * @filesource  tl_content.php
 * @version     1.0.0
 * @since       14.11.19 - 11:18
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2019
 * @license     EULA
 */
/**
 * Set Tablename: tl_content
 */
$strName = 'tl_content';

/* global_operations
$GLOBALS['TL_DCA'][$strName]['list']['global_operations'] = array
(
   'all' => array
   (
       'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
       'href'                => 'act=select',
       'class'               => 'header_edit_all',
       'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
   )
);

/* operations
$GLOBALS['TL_DCA'][$strName]['list']['operations']['delete'] = array
(
   'label'               => &$GLOBALS['TL_LANG'][$strName]['delete'],
   'href'                => 'act=delete',
   'icon'                => 'delete.gif',
   'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
);

/* slectors
$GLOBALS['TL_DCA'][$strName]['palettes']['__selector__'][] = 'SUBFIELD';

/* Palettes */
$GLOBALS['TL_DCA'][$strName]['palettes']['cemassage'] = '{type_legend},type,headline;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop;';

/* subpalettes
$GLOBALS['TL_DCA'][$strName]['subpalettes']['SUBFIELD'] = 'FIELDS';

/* Fields
$GLOBALS['TL_DCA'][$strName]['fields']['title'] = array
(
   'label'                   => &$GLOBALS['TL_LANG'][$strName]['title'],
   'exclude'                 => true,
   'inputType'               => 'text',
   'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
   'sql'                     => "varchar(255) NOT NULL default ''"
);
/**/