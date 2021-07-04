<?php


namespace App\Core\Billing\Domain\Model;

use App\Core\Billing\Domain\ValueObject\BillId;
use App\Core\Billing\Domain\ValueObject\BillNumber;
use App\Core\Billing\Domain\ValueObject\BillPeriod;
use App\Core\Billing\Domain\ValueObject\BillTaxPercent;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Bill
{
    #[ORM\Id, ORM\Column(type: "string", length: 36)]
    private string $id;

    #[ORM\Column(type: "string", length: BillNumber::MAX_LENGTH)]
    private string $number;

    #[ORM\Column(type: "datetime_immutable")]
    private DateTimeImmutable $periodFrom;

    #[ORM\Column(type: "datetime_immutable")]
    private DateTimeImmutable $periodTo;

    #[ORM\Column(type: "float")]
    private float $taxPercent;

    #[ORM\Column(type: "datetime_immutable")]
    private DateTimeImmutable $createdAt;

    //todo
    /*private Creditor $creditor;
    private Customer $customer;
    private array $items;*/

    public function __construct(BillId $id, BillNumber $number, BillPeriod $period, BillTaxPercent $taxPercent)
    {
        $this->id = $id->value();
        $this->number = $number->value();
        $this->periodFrom = $period->from();
        $this->periodTo = $period->to();
        $this->taxPercent = $taxPercent->value();
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): BillId
    {
        return BillId::fromString($this->id);
    }

    public function getNumber(): BillNumber
    {
        return BillNumber::fromString($this->number);
    }

    public function getPeriod(): BillPeriod
    {
        return BillPeriod::fromDates($this->periodFrom, $this->periodTo);
    }

    public function getTaxPercent(): BillTaxPercent
    {
        return BillTaxPercent::fromNumber($this->taxPercent);
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Only for demo purposes.
     */
    public function replaceNumber(BillNumber $newNumber): void
    {
        $this->number = $newNumber->value();
    }
}