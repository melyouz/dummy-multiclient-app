<?php


namespace App\Core\Billing\Presentation\Front\Controller;


use App\Core\Billing\Application\Generator\PdfBillGeneratorInterface;
use App\Core\Billing\Domain\Model\Bill;
use App\Core\Billing\Domain\Repository\BillRepositoryInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    private PdfBillGeneratorInterface $pdfBillGenerator;
    private BillRepositoryInterface $billRepository;
    private ParameterBagInterface $parameterBag;

    public function __construct(PdfBillGeneratorInterface $pdfBillGenerator, BillRepositoryInterface $billRepository, ParameterBagInterface $parameterBag)
    {
        $this->pdfBillGenerator = $pdfBillGenerator;
        $this->billRepository = $billRepository;
        $this->parameterBag = $parameterBag;
    }

    #[Route(path: '/test', name: 'app_billing_test', methods: [Request::METHOD_GET])]
    public function __invoke(): Response
    {
        /** @var Bill $bill */
        if (!$bill = $this->billRepository->all()->first()) {
            return new Response('Bills not found', Response::HTTP_NOT_FOUND);
        }

        $billPath = $this->pdfBillGenerator->generate($bill);
        dd($billPath);

        return new Response('');
    }
}