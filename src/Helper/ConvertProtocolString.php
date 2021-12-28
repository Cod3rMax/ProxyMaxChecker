<?php

namespace Codermax\Proxymaxchecker\Helper;

class ConvertProtocolString
{

    public static function ConvertProtocol($Protocol)
    {

        if($Protocol === "CURLPROXY_HTTP"){
            return "HTTP";
        }

        else if($Protocol === "CURLPROXY_HTTPS"){
            return "HTTPS";
        }

        else if($Protocol === "CURLPROXY_SOCKS5"){
            return "SOCKS5";
        }

        else if($Protocol === "CURLPROXY_SOCKS4"){
            return "SOCKS4";
        }

        else{
            return "SOCKS4A";
        }

    }


}
