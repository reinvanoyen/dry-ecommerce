<?php

namespace Tnt\Ecommerce\Contracts;

interface ShopInterface
{
    /**
     * @param PaymentInterface $payment
     * @return mixed
     */
    public function addPayment(PaymentInterface $payment);

    /**
     * @param $id
     * @return PaymentInterface
     */
    public function getPayment($id): PaymentInterface;

    /**
     * @param $id
     * @return bool
     */
    public function hasPayment($id): bool;

    /**
     * @return array
     */
    public function getPayments(): array;

    /**
     * @param FulfillmentInterface $fulfillment
     * @return mixed
     */
    public function addFulfillment(FulfillmentInterface $fulfillment);

    /**
     * @param $id
     * @return FulfillmentInterface
     */
    public function getFulfillment($id): FulfillmentInterface;

    /**
     * @param int $id
     * @return bool
     */
    public function hasFulfillment($id): bool;

    /**
     * @return array
     */
    public function getFulfillments(): array;

    /**
     * @param DiscountInterface $discount
     * @return mixed
     */
    public function addDiscount(DiscountInterface $discount);

    /**
     * @param $id
     * @return DiscountInterface
     */
    public function getDiscount($id): DiscountInterface;

    /**
     * @return bool
     */
    public function hasDiscount(DiscountInterface $discount): bool;

    /**
     * @return array
     */
    public function getDiscounts(): array;
}