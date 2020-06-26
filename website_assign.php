<?php    
    include_once './app/Mage.php';
    Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

    $updates_file = "./var/export/category_assign.csv";
	$websites = array(2, 136, 470);
	
    $sku_entry = array();
    $updates_handle = fopen($updates_file, 'r');
    if($updates_handle) {
        while($sku_entry = fgetcsv($updates_handle, 1000, ",")) {
            $sku = $sku_entry[0];
            echo "<br>Updating category of " . $sku . " - ";
            try {
                $get_item = Mage::getModel('catalog/product')->loadByAttribute('sku', $sku);
                if ($get_item) {
                    $get_item->setWebsiteIds($websites);
					$get_item->save();
                    echo "successful";
                } else {
                    echo "item not found";
                }
            } catch (Exception $e) {
                echo "Cannot retrieve products from Magento: ".$e->getMessage()."<br>";
                return;
            }
        }
    }
    fclose($updates_handle);