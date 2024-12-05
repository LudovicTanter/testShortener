# Shortener Service

This shortener service is using Laravel.
You can easily shorten any URL using it.
Two endpoints are available to do so:

- `/encode` - to encode the url into a shortened one
- `/decode` - to decode/retrieve the full url from a shortened one

Both endpoints expect a "url" query parameter to provide the related url.

## Usage

Launch the Laravel project locally with the following command:
```
$ php artisan serve
```
Access the localhost endpoints with your browser or Postman:
`http://127.0.0.1:8000/encode?url=https://google.com`

With the response provided in a JSON format, you can use the "url" property which is the shortened URl related to https://google.com.

You can decode it:
`http://127.0.0.1:8000/decode?url={shortenedUrl}`
This will return you a JSON with https://google.com in the "url" property.

## Constants

I have used two constants located in the `app/Services/ShortenerService.php` in order to configure the HTTP protocol and the host for the shortener service.

## Persist

I have used the default MySQLite database to persist data.
A check is done to prevent primary key conflict so it generates a new short URL key, but no diplication check is done on the full URL.
It can be an evolution to prevent having too much data in the datavase.