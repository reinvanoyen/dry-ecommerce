## Payment

### Implement a custom Payment

The key words “MUST”, “MUST NOT”, “REQUIRED”, “SHALL”, “SHALL NOT”, “SHOULD”, “SHOULD NOT”, “RECOMMENDED”, “MAY”, 
and “OPTIONAL” in this document are to be interpreted as described in [RFC 2119](https://tools.ietf.org/html/rfc2119).

The word implementor in this document is to be interpreted as someone implementing the PaymentInterface in a e-commerce related library or project.

#### 1. Create Payment class 

Every Payment MUST implement `Tnt\Ecommerce\Contracts\PaymentInterface` to be able to work nicely with [dry-ecommerce](https://github.com/reinvanoyen/dry-ecommerce).

```php
<?php

use Tnt\Ecommerce\Contracts\PaymentInterface;
use Tnt\Ecommerce\Contracts\OrderInterface;

class MyCustomPayment implements PaymentInterface
{
  public function pay(OrderInterface $order)
  {
  }
}
```

#### 2. Dispatch events

Once a payment is completed the `pay`-method MUST dispatch a `Tnt\Ecommerce\Events\Order\Paid` and SHOULD dispatch `Tnt\Ecommerce\Events\Order\PaymentCanceled`, `Tnt\Ecommerce\Events\Order\PaymentExpired` and `Tnt\Ecommerce\Events\Order\PaymentFailed` when needed.

Dispatching these events can be done by injecting `Oak\Contracts\DispatcherInterface` into the constructor of the Payment.

#### 3. Further notes and requirements

A Payment MUST allow the `Tnt\Ecommerce\Events\Order\Paid` event to be dispatched, even if the given order has a total of zero (or less). A payment MUST be able to give things away for free, this because of the possibility of a coupon or discount being used. An extra condition to check if a coupon or discount is being used when the total of the order equals zero MAY be implemented in the `pay`-method for security reasons.

### A basic example

This examples uses an imaginary `Acme\PaymentClient` for demonstration purposes.

```php
<?php

use Tnt\Ecommerce\Contracts\PaymentInterface;
use Tnt\Ecommerce\Contracts\OrderInterface;
use Oak\Contracts\DispatcherInterface;
use Acme\PaymentClient;

class MyCustomPayment implements PaymentInterface
{
  private $client;
  
  private $dispatcher;
  
  public function __construct(PaymentClient $client, DispatcherInterface $dispatcher)
  {
    $this->client = $client;
    $this->dispatcher = $dispatcher;
  }
  
  public function pay(OrderInterface $order)
  {
    $total = $order->getTotal();
    
    if ($total <= 0) {
      $this->dispatcher->dispatch(Paid::class, new Paid($order));
      return;
    }
    
    $status = $this->client->pay($total);
    
    if ($status === 'paid') {
      $this->dispatcher->dispatch(Paid::class, new Paid($order));
      return;
    }
    
    $this->dispatcher->dispatch(PaymentFailed::class, new PaymentFailed($order));
  }
}
```