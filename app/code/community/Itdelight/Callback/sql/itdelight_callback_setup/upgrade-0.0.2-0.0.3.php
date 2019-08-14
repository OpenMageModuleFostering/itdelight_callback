<?php
/**
 * Itdelight Callback
 *
 * @author     ItDelight Team
 * @contact    info@itdelight.com
 * @category   module configuration
 * @package    Itdelight_Callback
 * @site       https://itdelight.com/
 * @copyright  Copyright (c) 2016 Itdelight Callback
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;
$tableCallback = $installer->getTable('itdelight_callback/itdelight_callback');
$installer->startSetup();

$table = $installer->getConnection()
                   ->modifyColumn($tableCallback, 'called', array(
                       'nullable'  => true,
                       'type' => Varien_Db_Ddl_Table::TYPE_DATETIME,
                       'length' => null,
                   ));

$installer->endSetup();