<?php

    include_once './app/Mage.php';
    Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

    $update_file = "./var/export/set_attributes.csv";

    $catalog = Mage::getModel('catalog/product');

    // attribute map
    $attributes = array();

    $csv = array_map('str_getcsv', file($update_file));
    foreach ($csv as $attribute)
      $attributes[$attribute[0]] = $attribute[1];

    try {
      $ids = Mage::getModel('catalog/product')->getCollection()->getAllIds();
      foreach ($ids as $id) {
        $get_item = $catalog->load($id);
        if($get_item) {
          echo 'Setting attributes for : ' . $get_item['sku'] . '<br>';
          foreach ($attributes as $key => $value)
            $get_item->setData(trim($key), trim($value));

          $get_item->save();
        }
      }

      echo '<h1>Done!</h1>';
    } catch (Exception $e) {
      echo "Cannot retrieve products from Magento: ".$e->getMessage()."<br>";
      return;
    }
?>
