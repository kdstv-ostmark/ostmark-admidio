<?php
namespace Admidio\Users\Service;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Exception;

class QrCodeService
{
    /**
     * Generates a QR code for a vCard
     * @param string $vCardData The vCard data as string
     * @return string Base64 encoded PNG image
     * @throws Exception
     */
    public static function generateVCardQrCode(string $vCardData): string
    {
        try {
            $qrCode = new QrCode($vCardData);
            $qrCode->setSize(300);
            $qrCode->setMargin(10);
            
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            
            return 'data:image/png;base64,' . base64_encode($result->getString());
        } catch (\Exception $e) {
            throw new Exception('Failed to generate QR code: ' . $e->getMessage());
        }
    }
}
