<?php

include_once './app/Mage.php';
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

$ordersIds = array(
    '1',
    '2',
);

foreach ($ordersIds as $orderId) {
    $order = Mage::getModel('sales/order')->loadByIncrementId($orderId);

	// status slug and comment
    $order->addStatusToHistory('complete_shipped', 'Status comment');
    $order->save();
}
