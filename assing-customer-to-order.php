<?php

$customerEmail = '';
$orderIncrementId = '';

/** @var Mage_Customer_Model_Customer $customer */
$customer = Mage::getModel('customer/customer');
$customer->setWebsiteId(1);
$customer->loadByEmail($customerEmail);

/** @var Mage_Sales_Model_Order $order */
$order = Mage::getModel('sales/order');
$order->loadByIncrementId($orderIncrementId);

$order->setCustomer($customer);
$order->setCustomerId($customer->getId());
$order->setCustomerFirstname($customer->getFirstname());
$order->setCustomerLastname($customer->getLastname());
$order->setCustomerEmail($customer->getEmail());
$order->setCustomerGroupId($customer->getGroupId());
$order->setCustomerIsGuest(0);

$order->save();
