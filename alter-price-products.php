<?php

try {
    $file = __DIR__ . '/products.csv';

    /** @var Varien_File_Csv $products */
    $products = new Varien_File_Csv();
    $products->setDelimiter(';');
    $productsRows = $products->getData($file);

    /** @var Mage_Catalog_Model_Product  $productModel */
    $productModel = Mage::getModel('catalog/product');
    array_shift($productsRows);

    $errors = [];

    foreach ($productsRows as $product) {
        try {
            $id = $productModel->getIdBySku(trim($product[0]));
            $productModel->load($id);
            if ($productModel->getId()) {
                $productModel->setPrice(round(str_replace(',', '.', str_replace('.', '', $product[2])), 4));
                $productModel->save();
            }
            $productModel->clearInstance();
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