dspacelabs/http-message
=======================

This is a simple, very basic implementation of the PSR-7 standard. This library
does not come with a client and only deals with the messages.

## Installation

```bash
composer require dspacelabs/http-message
```

## Examples

### Creating URIs

```php
use Dspacelabs\Component\Http\Message\Uri;

$uri = new Uri();
$uri
    ->withScheme('http')
    ->withHost('www.example.com');
```

### Creating Requests

```php
use Dspacelabs\Component\Http\Message\Uri;
use Dspacelabs\Component\Http\Message\Request;

$uri = (new Uri())
    ->withScheme('http')
    ->withHost('www.example.com');

$request = new Request();
$request
    ->withMethod('GET')
    ->withUri($uri);

```

### Creating Responses

```php
use Dspacelabs\Component\Http\Message\Response;

$resposne = new Response();
$response
    ->withStatus(200, 'OK');
```

## Change Log

## License
