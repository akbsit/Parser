# Parser

Короткая запись получения страницы:

```php
$arHtml = Parser::getPage([
    "url" => "http://httpbin.org/ip" // string Ссылка на страницу
]);
```

При успешной отработке возвращает – **массив с данными о странице** в другом случае – **false**.

Дополнительные параметры:

```php
"useragent" => "Mozilla/5.0", // string Содержимое заголовка "User-Agent: ", посылаемого в HTTP-запросе
"timeout" => 5, // int Максимально позволенное количество секунд для выполнения CURL-функций
"connecttimeout" => 5, // int Количество секунд ожидания при попытке соединения
"head" => false, // bool Для вывода заголовков без тела документа
"cookie" => [
    "file" => "cookie.txt", // string Файл для хранения cookie
    "session" => false // bool Для указания текущему сеансу начать новую "сессию" cookies
]
"proxy" => [
    "ip" => "127.0.0.1", // string IP адрес прокси сервера
    "port" => 80, // int Порт прокси сервера
    "type" => "CURLPROXY_HTTP" // string Тип прокси сервера
],
"headers" => [ // array Массив устанавливаемых HTTP-заголовков
    "Content-type: text/plain",
    "Content-length: 100"
],
"post" => "'param1=val1&param2=val2" // string Все данные, передаваемые в HTTP POST-запросе
```

Все дополнительные параметры не обязательны для заполнения.

# Статья

[Пишем парсер контента на PHP](http://falbar.ru/article/pishem-parser-kontenta-na-php)