<?php


namespace App\Core\Billing\Infrastructure\Persistence\ORM\Repository;


use App\Core\Billing\Domain\Model\Bill;
use App\Core\Billing\Domain\Repository\BillRepositoryInterface;
use App\Core\Billing\Domain\ValueObject\BillCollection;
use App\Core\Billing\Domain\ValueObject\BillId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Uid\Uuid;

class BillRepository implements BillRepositoryInterface
{
    private EntityManagerInterface $em;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
        $this->repository = $em->getRepository(Bill::class);
    }

    public function get(BillId $id): Bill
    {
        return $this->repository->find($id->value());
    }

    public function all(): BillCollection
    {
        $items = $this->repository->findAll();

        return new BillCollection($items);
    }

    public function save(Bill $bill)
    {
        $this->em->persist($bill);
        $this->em->flush();
    }

    public function nextIdentity(): BillId
    {
        return BillId::fromString((string)Uuid::v4());
    }
}