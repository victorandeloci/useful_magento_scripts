<?php
  include_once './app/Mage.php';
  Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

  $updates_file = "./var/export/disable_products_by_sku.csv";

  $allStores = Mage::app()->getStores();
  foreach ($allStores as $_eachStoreId => $val) {
    $_storeId[] = Mage::app()->getStore($_eachStoreId)->getId();
  }

  $sku_entry = array();
  $updates_handle = fopen($updates_file, 'r');
  if($updates_handle) {
      while($sku_entry = fgetcsv($updates_handle, 1000, ",")) {
          $sku = $sku_entry[0];
          echo "<br>Disabling " . $sku . " - ";
          try {

              for($i = 0; $i < count($_storeId); $i++) {

                $product_id = Mage::getModel('catalog/product')->getIdBySku($sku);
                $storeId = $_storeId[$i];
                Mage::getModel('catalog/product_status')->updateProductStatus($product_id, $storeId, Mage_Catalog_Model_Product_Status::STATUS_DISABLED);

              }

          } catch (Exception $e) {
              echo "Cannot retrieve products from Magento: ".$e->getMessage()."<br>";
              return;
          }
      }
  }
  fclose($updates_handle);
