# URL Shortening Example

Example URL shortening service.

## Tasks

Two endpoints are required:
/encode - Encodes a URL to a shortened URL
/decode - Decodes a shortened URL to its original URL
Both endpoints should return JSON.
There is no restriction on how your encode/decode algorithm should work. You just need to make sure that a URL can be encoded to a short URL and the short URL can be decoded to the original URL.
You do not need to persist short URLs if you don't need to you can keep them in memory.
Provide detailed instructions on how to run your assignment in a separate markdown file or readme.
Cover all functionality with tests.

#SETUP

## Recommended Setup

The project can be run in a docker container.
[https://github.com/LeonDaCosta/magicLAMP](https://github.com/LeonDaCosta/magicLAMP)

How-To [Installing magicLAMP](https://magiclamp.app/en/stable/getting-started/installing-magiclamp/)

## Requirments

- PHP 7.2+
- Composer
- Root Directory is /php-url-shortener/public

# HOW TO USE

> git clone git@github.com:LeonDaCosta/php-url-shortener.git
> cd shorturl
> composer install

## POST Requests

> POST /encode/ : {"url" : "https://www.someurl.com/with/some/parameters?and=here_too"}

> Return date:
> {
> "original_url": "https://www.someurl.com/with/some/parameters?and=here_too",
> "short_url": "http://short.com/dLAaLG"
> }

> POST /decode/ : {"url": "http://short.com/dLAaLG"}

> Return date:
> {
> "original_url": "www.someurl.com/with/some/parameters?and=here_too",
> "short_url": "http://short.com/dLAaLG",
> "created_date": "2024-06-30 16:42:23"
> }
