<?php

namespace Codermax\Proxymaxchecker;

use Codermax\Proxymaxchecker\Helper\ConvertProtocolString;

class Cod3rMaxChecker
{


    private function Cod3rMaxMaster($ProxyIP, $Protocol)
    {
        $userAgent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36";
        $TIMEOUT = 15;


        $checkProxy = curl_init();
        CURL_SETOPT($checkProxy, CURLOPT_URL, "https://www.ipvoid.com/ip-blacklist-check/");
        CURL_SETOPT($checkProxy, CURLOPT_POST, 1);
        CURL_SETOPT($checkProxy, CURLOPT_POSTFIELDS, "ip=" . explode(':', $ProxyIP)[0]);
        CURL_SETOPT($checkProxy, CURLOPT_USERAGENT, $userAgent);
        CURL_SETOPT($checkProxy, CURLOPT_PROXY, $ProxyIP);
        CURL_SETOPT($checkProxy, CURLOPT_PROXYTYPE, $Protocol);
        CURL_SETOPT($checkProxy, CURLOPT_FOLLOWLOCATION, TRUE);
        CURL_SETOPT($checkProxy, CURLOPT_RETURNTRANSFER, TRUE);
        CURL_SETOPT($checkProxy, CURLOPT_CONNECTTIMEOUT, $TIMEOUT);
        CURL_SETOPT($checkProxy, CURLOPT_TIMEOUT, $TIMEOUT);
        $execute = curl_exec($checkProxy);
        $httpCode = curl_getinfo($checkProxy);
        $httpCode = $httpCode['http_code'];

        preg_match_all('/<tr><td>Blacklist Status<\/td><td><span class="label label-(.*)">/i', $execute, $checkBlackList);


        if ($httpCode == 200 && !empty($checkBlackList[1][0])) {
            return response()->json([

                'Expression_Status' => True,
                'Status' => 'LIVE',
                'Protocol' => ConvertProtocolString::ConvertProtocol($Protocol),
                'HTTP_Code' => $httpCode,
                'Blacklist' => $checkBlackList[1][0] === 'danger' ? 'BLACKLISTED' : 'CLEAN',

            ], 200)->getData();
        } else {

            return response()->json([

                'Expression_Status' => False,
                'Status' => 'DEAD',
                'Protocol' => ConvertProtocolString::ConvertProtocol($Protocol),
                'HTTP_Code' => 0,
                'Blacklist' => 'N/A',

            ],200)->getData();
        }

    }


    public function HTTP($ProxyIP)
    {
        return $this->Cod3rMaxMaster($ProxyIP, 'CURLPROXY_HTTP');
    }


    public function HTTPS($ProxyIP)
    {
        return $this->Cod3rMaxMaster($ProxyIP, 'CURLPROXY_HTTPS');
    }


    public function SOCKS5($ProxyIP)
    {
        return $this->Cod3rMaxMaster($ProxyIP, 'CURLPROXY_SOCKS5');
    }


    public function SOCKS4($ProxyIP)
    {
        return $this->Cod3rMaxMaster($ProxyIP, 'CURLPROXY_SOCKS4');
    }


    public function SOCKS4A($ProxyIP)
    {
        return $this->Cod3rMaxMaster($ProxyIP, 'CURLPROXY_SOCKS4A');
    }


    public function GetProxyDetails($ProxyIP)
    {
        return response()->json(geoip(explode(':', $ProxyIP)[0])->toArray(), 200)->getData();
    }


}
