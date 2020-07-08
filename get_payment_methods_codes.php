<?php
    include_once './app/Mage.php';

    $storeId = 1; // change this to get payment methods based on store id

    Mage::app()->setCurrentStore($storeId);

    $allPaymentMethods = Mage::getModel('payment/config')->getAllMethods();
    foreach($allPaymentMethods as $paymentMethod) {
        echo 'Method: <b>' . $paymentMethod->getTitle() . '</b><br>';
        echo 'Payment code: <b>' . $paymentMethod->getCode() . '</b><br>';
        echo '------------------------------------------------------<br>';
    }
