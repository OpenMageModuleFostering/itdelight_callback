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

if (!$installer->tableExists($tableCallback)) {
    $table = $installer->getConnection()
        ->newTable($tableCallback)
        ->addColumn('callback_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity' => true,
            'nullable' => false,
            'primary' => true,
        ))
        ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, '255', array(
            'nullable' => false,
        ))
        ->addColumn('tel_number', Varien_Db_Ddl_Table::TYPE_TEXT, '15', array(
            'nullable' => false,
        ))
        ->addColumn('message', Varien_Db_Ddl_Table::TYPE_TEXT, '255', array(
            'nullable' => true,
        ))
        ->addColumn('status', Varien_Db_Ddl_Table::TYPE_BOOLEAN, '1', array(
            'nullable' => false,
            'default' => 0
        ))
        ->addColumn('created', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
            'nullable'  => false,
        ))
        ->addColumn('called', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
            'nullable'  => false,
        ));
    $installer->getConnection()->createTable($table);
}

$installer->endSetup();