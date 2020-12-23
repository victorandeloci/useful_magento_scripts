# useful_magento_scripts
Useful scripts to import/export/assign things in Magento

## About
I've used and tested this in Magento 1.9. Take care.

**I've not created all of this just by myself.** These scripts were created based on old scripts provided by [rafaldimas](https://github.com/rafaeldimas) and questions, like following:
* [https://stackoverflow.com/questions/28350783/how-to-replace-the-sku-number-for-5000-products-in-magento](https://stackoverflow.com/questions/28350783/how-to-replace-the-sku-number-for-5000-products-in-magento)

## Usage

#### Alter order status with comment

1. Put your order ids in the respective array:

```php
$ordersIds = array(
    '1',
    '2',
);
```

2. Then, add the status slug and comment:

```php
$order->addStatusToHistory('complete_shipped', 'Status comment');
```

3. Access *YOUR_SITE.XYZ/alter-status-add-comment.php*

#### Update SKU (Old SKU to new SKU) by import

1. Use the <code>sku2sku.csv</code> model.
* First column for your old SKUs
* Second column for your new SKUs

2. Upload the *.csv* file to <code>/var/export</code> directory

3. Upload the script file <code>updateskus.php</code> to your root directory

4. Access *YOUR_SITE.XYZ/updateskus.php*

#### Assign category ids to product mass

1. Use the <code>category_assign.csv</code> model.
* First column for your SKUs

2. Upload the *.csv* file to <code>/var/export</code> directory

3. Upload the script file <code>category_assign.php</code> to your root directory

4. Put the category ids in the respective array in <code>category_assign.php</code>:

```php
$categories = array(2, 136, 470);
```

5. Access *YOUR_SITE.XYZ/category_assign.php*

#### Assign Websites ids to product mass

1. Use the <code>website_assign.csv</code> model.
* First column for your SKUs

2. Upload the *.csv* file to <code>/var/export</code> directory

3. Upload the script file <code>website_assign.php</code> to your root directory

4. Put the website ids in the respective array in <code>website_assign.php</code>:

```php
$websites = array(1, 2);
```

5. Access *YOUR_SITE.XYZ/website_assign.php*

#### Get payment methods codes from store

1. Change the **$storeId** in <code>get_payment_methods_codes.php</code> tou YOUR store id:

```php
$storeId = 1;
```

2. Upload the script file <code>get_payment_methods_codes.php</code> to your root directory

3. Access *YOUR_SITE.XYZ/get_payment_methods_codes.php*

#### Disable products by SKU in ALL store views

1. Use the <code>disable_products_by_sku.csv</code> model.
* First column for your SKUs

2. Upload the *.csv* file to <code>/var/export</code> directory

3. Upload the script file <code>disable_products_by_sku.php</code> to your root directory

4. Access *YOUR_SITE.XYZ/disable_products_by_sku.php*

#### Set attribute value by attributte name for ALL PRODUCTS

1. Use the <code>set_attributes.csv</code> model.
* First column for your attribute names
* Second column form their values

2. Upload the *.csv* file to <code>/var/export</code> directory

3. Upload the script file <code>set_attributes.php</code> to your root directory

4. Access *YOUR_SITE.XYZ/set_attributes.php*

#### Change status of orders between dates

1. Upload the script file <code>update_orders_status.php</code> to your root directory

2. Set your date interval:
```php
$from = new DateTime('2020-01-01 00:00:00');
$from = $from->format('Y-m-d H:i:s');

$to = new DateTime('2020-12-22 23:59:9');
$to = $to->format('Y-m-d H:i:s');
```

3. Define your current order status for search:
```php
->addFieldToFilter('status', 'complete_shipped')
```

4. Define the final status:
```php
$order->addStatusToHistory('complete', 'Status manually updated on ' . date("d - m - Y") . '.');
```

5. Access *YOUR_SITE.XYZ/update_orders_status.php*
