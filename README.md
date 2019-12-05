# dry-ecommerce
## E-commerce platform

#### Index

* [Installation](#installation)
* [Payment](https://github.com/reinvanoyen/dry-ecommerce/blob/master/docs/payment.md)

#### Installation

```ssh
composer require reinvanoyen/dry-ecommerce
```

#### Register the service provider

```php
<?php

$app = new \Oak\Application();

$app->register([
    \Tnt\Ecommerce\EcommerceServiceProvider::class,
]);

$app->bootstrap();
```

#### Config options

Name | Default
---- | -------
payment | \Tnt\Ecommerce\Payment\NullPayment::class

**Careful!** Payment can be set from configuration. the default value of the "payment" config property provides a default NullPayment which basically gives everything away for free. For more info on payments check out the topic payments below.

### Buyable
Documentation coming soon

### Cart

```php
<?php

$cart = $app->get(CartInterface::class);

$cart->add($buyable, 2);
$cart->remove($buyable);
$cart->clear();
$items = $cart->items();

$cart->setFulfillment($shipping);
$fulfillment = $cart->getFulfillment();
$fulfillmentCost = $cart->getFulfillmentCost();

$cart->addDiscount($discountCode);
$discountCode = $cart->getDiscount();

$subTotal = $cart->getSubTotal();
$total = $cart->getTotal();
$reduction = $cart->getReduction();

$order = $cart->checkout($customer);
```

### Discount & Coupon
Documentation coming soon

### Fulfillment
Documentation coming soon

### Customer
Documentation coming soon

### Order
Documentation coming soon

### Stock
Documentation coming soon

### Tax
Documentation coming soon
