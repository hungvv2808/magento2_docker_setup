<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

use Magento\Quote\Api\CartRepositoryInterface;
use Magento\TestFramework\Helper\Bootstrap;
use Magento\TestFramework\Quote\Model\GetQuoteByReservedOrderId;

$objectManager = Bootstrap::getObjectManager();
/** @var CartRepositoryInterface $quoteRepository */
$quoteRepository = $objectManager->get(CartRepositoryInterface::class);
/** @var GetQuoteByReservedOrderId $getQuoteByReservedOrderId */
$getQuoteByReservedOrderId = $objectManager->get(GetQuoteByReservedOrderId::class);
$quote = $getQuoteByReservedOrderId->execute('test_order_with_not_visible_product');
if ($quote) {
    $quoteRepository->delete($quote);
}

require __DIR__ . '/../../../Magento/Catalog/_files/simple_products_not_visible_individually_rollback.php';
require __DIR__ . '/../../Customer/_files/customer_address_rollback.php';
require __DIR__ . '/../../Customer/_files/customer_rollback.php';
