<?php

include_once './app/Mage.php';
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

$updates_file = "./var/export/set_qtd_by_sku.csv";
$sku_entry = array();
$updates_handle = fopen($updates_file, 'r');

$cat = Mage::getModel('catalog/product');

if($updates_handle) {
	while($sku_entry=fgetcsv($updates_handle, 1000, ",")) {
		$sku = $sku_entry[0];
		$qtd = $sku_entry[1];
		echo "<br>Updating " . $sku . " to " . $qtd . " - ";
		try {
			$get_item = $cat->loadByAttribute('sku', $sku);
			if ($get_item) {
				try {
          $get_item->setData('qty', $qtd)->save();
        } catch (\Exception $e) {
          echo $e->getMessage();
        }

				echo "successful";
			} else {
				echo "item not found";
			}
		} catch (Exception $e) {
			echo "Cannot retrieve products from Magento: " . $e->getMessage()."<br>";
			return;
		}
	}
}
fclose($updates_handle);
