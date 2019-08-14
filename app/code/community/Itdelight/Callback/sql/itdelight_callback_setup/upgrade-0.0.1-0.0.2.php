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
                   ->addColumn($tableCallback, 'comment', array(
                       'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
                       'nullable' => true,
                       'length' => 255,
                       'comment' => 'comment set in admin section',
                   ));

$installer->endSetup();
