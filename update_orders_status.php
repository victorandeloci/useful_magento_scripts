<?php

include_once './app/Mage.php';
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

$from = new DateTime('2020-01-01 00:00:00');
$from = $from->format('Y-m-d H:i:s');

$to = new DateTime('2020-12-22 23:59:9');
$to = $to->format('Y-m-d H:i:s');

$orders = Mage::getModel('sales/order')->getCollection()
    ->addFieldToFilter('status', 'complete_shipped')
    ->addAttributeToFilter('created_at', array('from'=>$from, 'to'=>$to));
foreach ($orders as $order) {
  echo 'Atualizando status do pedido ' . $order->getId() . '<br>';
  $order->addStatusToHistory('complete', 'Status alterado manualmente no dia ' . date("d - m - Y") . '.');
  $order->save();
  echo '--- Atualizado com sucesso! --- <br><br>';
}

exit();
