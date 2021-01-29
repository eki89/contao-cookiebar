<?php
/**
 * This file is part of Oveleon Contao Cookiebar.
 *
 * @package     contao-cookiebar
 * @license     AGPL-3.0
 * @author      Daniele Sciannimanica <https://github.com/doishub>
 * @copyright   Oveleon <https://www.oveleon.de/>
 */

$GLOBALS['TL_DCA']['tl_cookie_config'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
        'switchToEdit'                => true,
        'enableVersioning'            => true,
        'markAsCopy'                  => 'title',
        'onload_callback' => array
        (
            array('tl_cookie_config', 'checkPermission')
        ),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
                'published' => 'index'
			)
		)
	),

	// List
	'list' => array
	(
        'sorting' => array
        (
            'mode'                    => 2,
            'fields'                  => array('title'),
            'flag'                    => 1,
            'panelLayout'             => 'sort,search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('title'),
            'format'                  => '%s'
        ),
		'global_operations' => array
		(
			'all' => array
			(
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_cookie_config']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.svg'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_cookie_config']['copy'],
                'href'                => 'act=paste&amp;mode=copy',
                'icon'                => 'copy.svg'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_cookie_config']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.svg',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_cookie_config']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.svg'
            )
		)
	),

	// Palettes
	'palettes' => array
	(
	    '__selector__'                => array('type'),
        'script'                      => '{title_legend},title,type;sourceUrl,sourceLoadingMode,sourceUrlParameter;scriptConfirmed,scriptUnconfirmed,scriptPosition;',
        'tagManager'                  => '{title_legend},title,type;vendorId,googleConsentMode,scriptConfig;'
	),

    // Fields
	'fields' => array
	(
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default 0"
        ),
        'title' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_cookie_config']['title'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'type' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_cookie_config']['type'],
            'exclude'                 => true,
            'filter'                  => true,
            'search'                  => true,
            'default'                 => 'script',
            'inputType'               => 'select',
            'options'                 => array('script','tagManager'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_cookie_config'],
            'eval'                    => array('helpwizard'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50'),
            'sql'                     => array('name'=>'type', 'type'=>'string', 'length'=>64, 'default'=>'text')
        ),
        'vendorId' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_cookie_config']['vendorId'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''",
            'load_callback'           => array(
                array('tl_cookie_config', 'overwriteTranslation')
            )
        ),
        'sourceUrl' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_cookie_config']['sourceUrl'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'dcaPicker'=>true, 'addWizardClass'=>false, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'sourceLoadingMode' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_cookie_config']['sourceLoadingMode'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array(
                1 => 'confirmed',
                2 => 'unconfirmed',
                3 => 'always'
            ),
            'reference'               => &$GLOBALS['TL_LANG']['tl_cookie_config'],
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'sourceUrlParameter' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_cookie_config']['sourceUrlParameter'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'options'                 => array('async', 'defer'),
            'eval'                    => array('multiple'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'scriptConfirmed' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_cookie_config']['scriptConfirmed'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
            'eval'                    => array('preserveTags'=>true, 'decodeEntities'=>true, 'class'=>'monospace', 'rte'=>'ace|javascript', 'tl_class'=>'clr'),
            'sql'                     => "text NULL"
        ),
        'scriptUnconfirmed' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_cookie_config']['scriptUnconfirmed'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
            'eval'                    => array('preserveTags'=>true, 'decodeEntities'=>true, 'class'=>'monospace', 'rte'=>'ace|javascript', 'tl_class'=>'clr'),
            'sql'                     => "text NULL"
        ),
		'scriptPosition' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_cookie_config']['scriptPosition'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array(
                1 => 'bodyBelowContent',
                2 => 'bodyAboveContent',
                3 => 'head'
            ),
            'reference'               => &$GLOBALS['TL_LANG']['tl_cookie_config'],
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
        ),
        'scriptConfig' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_cookie_config']['scriptConfig'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
            'eval'                    => array('preserveTags'=>true, 'decodeEntities'=>true, 'helpwizard'=>true, 'class'=>'monospace', 'rte'=>'ace|javascript', 'tl_class'=>'clr'),
            'sql'                     => "text NULL",
            'explanation'             => 'configurationScriptConfig',
            'xlabel' => array
            (
                array('tl_cookie_config', 'selectScriptPreset')
            ),
        ),
        'googleConsentMode' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_cookie_config']['googleConsentMode'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'published' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_cookie_config']['published'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default '1'"
        )
	)
);

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_cookie_config extends Contao\Backend
{
    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('Contao\BackendUser', 'User');
    }

    /**
     * Check permissions to edit table tl_cookie_config
     */
    public function checkPermission()
    {
        if ($this->User->isAdmin)
        {
            return;
        }
    }

    /**
     * Load translations for general fields
     *
     * @param $varValue
     * @param $dc
     *
     * @return mixed
     */
    public function overwriteTranslation($varValue, $dc)
    {
        $field = $dc->activeRecord->type . '_' . $dc->field;

        if($tl = $GLOBALS['TL_LANG']['tl_cookie_config'][$field])
        {
            $GLOBALS['TL_DCA']['tl_cookie_config']['fields'][$dc->field]['label'] = $tl;
        }

        return $varValue;
    }

    /**
     * Add button for adding default script configurations
     *
     * @param $dc
     *
     * @return mixed
     */
    public function selectScriptPreset($dc)
    {
        $id = 'script' . $dc->activeRecord->type;
        return ' <a href="javascript:;" id="'.$id.'" title="' . $GLOBALS['TL_LANG']['tl_cookie_config']['scriptConfig_xlabel'] . '" onclick="Backend.getScrollOffset();ace.edit(\'ctrl_' . $dc->field . '_div\').setValue(Cookiebar.getConfig(\''.$dc->activeRecord->type.'\'))">' . Contao\Image::getHtml('theme_import.svg', $GLOBALS['TL_LANG']['tl_cookie']['scriptConfig_xlabel']) . '</a><script>Cookiebar.issetConfig(\''.$dc->activeRecord->type.'\',document.getElementById(\''.$id.'\'));</script>';
    }
}
