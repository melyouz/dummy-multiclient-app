<?php


namespace App\Core\Billing\Infrastructure\Generator;


use App\Core\Billing\Application\Generator\PdfBillGeneratorInterface;
use App\Core\Billing\Domain\Model\Bill;
use App\Core\Billing\Domain\ValueObject\BillCollection;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Environment;

class PdfBillGenerator implements PdfBillGeneratorInterface
{
    protected string $template;
    protected ParameterBagInterface $parameterBag;
    protected Environment $twig;

    public function __construct(string $template, ParameterBagInterface $parameterBag, Environment $twig)
    {
        $this->template = $template;
        $this->parameterBag = $parameterBag;
        $this->twig = $twig;
    }

    public function generate(Bill $bill): string
    {
        $html = $this->twig->render($this->template, ['bill' => $bill]);
        $path = $this->guessLocalPath($bill);
        $this->renderPdf($html, $path);

        return $path;
    }

    public function generateAll(BillCollection $bills): void
    {
        $billsArr = $bills->toArray();
        array_walk($billsArr, [$this, 'generate']);
    }

    protected function renderPdf(string $html, string $path): void
    {
        $options = new Options();
        $options->setDefaultFont('Arial');
        $options->setIsHtml5ParserEnabled(true);

        $domPdf = new Dompdf($options);
        $domPdf->loadHtml($html);
        $domPdf->setPaper('A4', 'portrait');
        $domPdf->render();

        file_put_contents($path, $domPdf->output());
        $domPdf->stream();
    }

    protected function guessLocalPath(Bill $bill): string
    {
        return sprintf('%s/%s.pdf', $this->parameterBag->get('app.billing.bills_path'), $bill->getNumber());
    }
}