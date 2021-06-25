# PHP Micro Framework

```php
$app = new Application();

$app->factory(MyCustomService::class, function() {
  return new MyCustomService(24);
});

$app->get('/', function(Request $request, Response $response, MyCustomService $service) {  
  return $response
    ->code(204)
    ->json([
      'method' => $request->getMethod(),
      'response' => $service->getData()
    ]);
});

$app->run();
```

### Application

* `get()`
* `post()`
* `put()`
* `delete()`
* `factory()`
* `catch()`
### Request

* `getMethod()`
* `getParam()`
* `getPath()`
* `getQueryParam()`

### Response

* `json()`
* `body()`
* `code()`
* `header()`