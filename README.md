# ProxyMaxChecker

The power of proxy checking.

## Introduction

Proxymaxchecker is a Laravel project designed to help you check your proxies in format [ProxyIP:Port].

## Installation

Use composer to install ProxyMaxChecker.

```bash
composer require codermax/proxymaxchecker
```

## Usage Example

```php
$Cod3rMax = new Cod3rMaxChecker();

return $Cod3rMax->HTTP('121.139.218.165:31409');
```

### Returned Json Data For [Live] Proxy

```php
{
  "Expression_Status": true,
  "Status": "LIVE",
  "Protocol": "CURLPROXY_HTTP",
  "HTTP_Code": 200,
  "Blacklist": "BLACKLISTED"
}
```


### Returned Json Data For [Dead] Proxy

```php
{
  "Expression_Status": false,
  "Status": "DEAD",
  "Protocol": "CURLPROXY_HTTP",
  "HTTP_Code": 0,
  "Blacklist": "N/A"
}
```

### Checking Methods that can be used

```php
$Cod3rMax->HTTP()
$Cod3rMax->HTTPS()
$Cod3rMax->SOCKS5()
$Cod3rMax->SOCKS4()
$Cod3rMax->SOCKS4A()
```

#### The checker also return if the proxy is blacklisted or clean.

### Get more info about the proxy

```php
$Cod3rMax = new Cod3rMaxChecker();
return $Cod3rMax->GetProxyDetails('127.0.0.0:3128');
```
### Returned Json Data For Proxy Details

```php
{
  "ip": "127.0.0.0",
  "iso_code": "US",
  "country": "United States",
  "city": "New Haven",
  "state": "CT",
  "state_name": "Connecticut",
  "postal_code": "06510",
  "lat": 41.31,
  "lon": -72.92,
  "timezone": "America/New_York",
  "continent": "NA",
  "currency": "USD",
  "default": true,
  "cached": false
}
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)
