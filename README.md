# Parser

A short recording of page retrieval:

```php
$arHtml = Parser::getPage([
    "url" => "http://httpbin.org/ip"
]);
```

If successful, returns **array with page data**; otherwise, **false**.

Extra options:

```php
"useragent" => "Mozilla/5.0",
"timeout" => 5,
"connecttimeout" => 5,
"head" => false,
"cookie" => [
    "file" => "cookie.txt",
    "session" => false
]
"proxy" => [
    "ip" => "127.0.0.1",
    "port" => 80,
    "type" => "CURLPROXY_HTTP"
],
"headers" => [
    "Content-type: text/plain",
    "Content-length: 100"
],
"post" => "'param1=val1&param2=val2"
```

All additional parameters are optional.
