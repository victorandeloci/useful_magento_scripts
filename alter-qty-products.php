<?php

try {
    $file = __DIR__ . '/products.csv';

    /** @var Varien_File_Csv $products */
    $products = new Varien_File_Csv();
    $products->setDelimiter(';');
    $productsRows = $products->getData($file);
    array_shift($productsRows);

    /** @var Mage_Catalog_Model_Product  $productModel */
    $productModel = Mage::getModel('catalog/product');

    /** @var Mage_CatalogInventory_Model_Stock_Item  $productModel */
    $stockItemModel = Mage::getModel('cataloginventory/stock_item');

    $errors = [];

    foreach ($productsRows as $product) {
        try {
            $id = $productModel->getIdBySku(trim($product[0]));
            $stockItemModel->loadByProduct($id);
            if (!$stockItemModel->getId() || !$stockItemModel->getManageStock()) {
                $stockItemModel->clearInstance();
                throw new Exception('Product not found or not manage.');
            }
            $stockItemModel->setQty($product[2]);
            $stockItemModel->setIsInStock((int)($product[2] > 0));
            $stockItemModel->save();
            $stockItemModel->clearInstance();
        } catch (Exception $e) {
            $errors[] = [
                'message' => $e->getMessage(),
                'product' => $product
            ];
        }
    }
} catch (Exception $e) {
    $this->log($e);
}

if (!empty($errors)) {
    $this->log($errors);
}