<?php


namespace App\Core\Billing\Application\Generator;


use App\Core\Billing\Domain\Model\Bill;
use App\Core\Billing\Domain\ValueObject\BillCollection;

interface PdfBillGeneratorInterface
{
    /** @return string Bill local fs path */
    public function generate(Bill $bill): string;
    public function generateAll(BillCollection $bills): void;
}