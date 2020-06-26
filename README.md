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

4. Put the category ids in the respective array in <code>website_assign.php</code>:

```php
$categories = array(2, 136, 470);
```

5. Access *YOUR_SITE.XYZ/website_assign.php*
