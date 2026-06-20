<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SoapService
{
    private string $soapUrl = 'https://iae-sso.virtualfri.id/soap/v1/audit';
    private string $teamId = 'TEAM-05';

    public function sendAudit(string $activityName, array $logContent, string $bearerToken): array
    {
        $logJson = json_encode($logContent);

        $xmlBody = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:iae="http://iae.central/audit">
    <soap:Body>
        <iae:AuditRequest>
            <iae:TeamID>{$this->teamId}</iae:TeamID>
            <iae:ActivityName>{$activityName}</iae:ActivityName>
            <iae:LogContent><![CDATA[{$logJson}]]></iae:LogContent>
        </iae:AuditRequest>
    </soap:Body>
</soap:Envelope>
XML;

        $response = Http::withHeaders([
            'Content-Type'  => 'text/xml; charset=UTF-8',
            'Authorization' => 'Bearer ' . $bearerToken,
            'SOAPAction'    => 'audit',
        ])->withBody($xmlBody, 'text/xml')->post($this->soapUrl);

        $receiptNumber = null;
        if (preg_match('/<iae:ReceiptNumber>(.*?)<\/iae:ReceiptNumber>/', $response->body(), $matches)) {
            $receiptNumber = $matches[1];
        }

        $status = 'FAILED';
        if (preg_match('/<iae:Status>(.*?)<\/iae:Status>/', $response->body(), $matches)) {
            $status = $matches[1];
        }

        return [
            'status'         => $status,
            'receipt_number' => $receiptNumber,
            'raw_response'   => $response->body(),
        ];
    }
}