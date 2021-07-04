<?php


namespace App\Core\Billing\Domain\Repository;


use App\Core\Billing\Domain\Model\Bill;
use App\Core\Billing\Domain\ValueObject\BillCollection;
use App\Core\Billing\Domain\ValueObject\BillId;

interface BillRepositoryInterface
{
    public function get(BillId $id): Bill;
    public function all(): BillCollection;
    public function save(Bill $bill);
    public function nextIdentity(): BillId;
}