<?php
namespace App\Services;
use App\Services\Contracts\ValutesInfoServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;


class ValutesInfoService implements ValutesInfoServiceInterface
{
    public function takeXml($date)
    {
       $response = HTTP::get('http://www.cbr.ru/scripts/XML_daily.asp?',[
            'date_req'=> $date,
        ]);
        $xml = simplexml_load_string($response);
        /*
         * XML приходит довольно простой и парсинга не требует , поэтому сразу вывожу его
         */
        if ($xml->Valute) {
            $json = json_encode($xml);
            return $json;
        }
    }
}
