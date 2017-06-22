dspacelabs/http-message [![Build Status](https://travis-ci.org/dSpaceLabs/http-message.svg?branch=master)](https://travis-ci.org/dSpaceLabs/http-message)
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

$uri = (new Uri())
    ->withScheme('http')
    ->withHost('www.example.com');
```

If you want something less verbose, you can also pass in the URL when creating
new Uri objects.

```php
use Dspacelabs\Component\Http\Message\Uri;

$uri = new Uri('http://www.example.com');
```

### Creating Requests

```php
use Dspacelabs\Component\Http\Message\Uri;
use Dspacelabs\Component\Http\Message\Request;

$request = new Request();
$request
    ->withMethod('GET')
    ->withUri(new Uri('http://www.example.com'));

```

### Creating Responses

```php
use Dspacelabs\Component\Http\Message\Response;

$resposne = new Response();
$response
    ->withStatus(200, 'OK');
```

## Testing

Testing is done with PHPUnit and Phing. Once you make updates, run the command

```bash
./vendor/bin/phing
```

And this will run PHPUnit and give you test results.
