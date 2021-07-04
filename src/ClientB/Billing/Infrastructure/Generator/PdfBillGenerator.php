<?php


namespace App\ClientB\Billing\Infrastructure\Generator;

use App\Core\Billing\Domain\Model\Bill;
use App\Core\Billing\Domain\ValueObject\BillNumber;

class PdfBillGenerator extends \App\Core\Billing\Infrastructure\Generator\PdfBillGenerator
{
    public function generate(Bill $bill): string
    {
        // Only for demo purposes
        $bill->replaceNumber(BillNumber::fromString(sprintf('ClientB-%s', $bill->getNumber()->value())));

        $html = $this->twig->render($this->template, ['bill' => $bill]);
        $path = $this->guessLocalPath($bill);
        $this->renderPdf($html, $path);

        return $path;
    }
}