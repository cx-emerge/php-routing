# 简介
一个基础的PHP路由

# 快速入门
```php
$routing = new Routing();

$routing->get(
    '/admin',
    ['App\Admin', 'index']
);

$routing->get(
    '/admin/user/$id',
    ['App\Admin', 'index'],
    [
        'requirements' => [
            'id' => '\d+'
        ]
    ]
);

$result = $routing->dispatch('GET', '/admin/user/1');

print_r($result);
```
`输出内容`
```
Array
(
    [route] => /admin/user/$id

    [callback] => Array
    (
        [0] => App\Admin
        [1] => index
    )

    [options] => Array
    (
        [requirements] => Array
        (
            [id] => \d+
        )

        [method] => Array
        (
            [0] => GET
        )
    )

    [parameters] => Array
    (
        [0] => /admin/user/1
        [id] => 1
        [1] => 1
    )
)
```

# 常量
## `VERSION`
> 
**string**  
*版本号*

```php
$routing::VERSION
```

# API
## `get` - *路由设置*
> 
*array* `get` (*string* **$route**, *array|callable* **$callback**, [*array* **$options = []**])  
*返回添加的路由数据*

### 参数
> `route`
>> 路由路径

> `callback`
>> 路由回调,[参考链接](http://php.net/manual/zh/language.types.callable.php)

> `options`
>> 路由选项, 支持 **requirements**,**method** 两个选项

### 返回值
```
Array
(
    [route] => /admin/user/$id
    
    [callback] => Array
    (
        [0] => App\Admin
        [1] => index
    )
    
    [options] => Array
    (
        [requirements] => Array
        (
            [id] => \d+
        )

        [method] => Array
        (
            [0] => GET
        )
    )
)
```

### 示例
```php
$routing->get(
    '/admin/user/$id',
    ['App\Admin', 'index'],
    [
        'method' => ['GET', 'POST']
        'requirements' => [
            'id' => '\d+'
        ]
    ]
);
```

## `dispatch` - *分派路由*
> 
array `dispatch` (*string* **$method**, *string* **$uri**)  
返回路由分派结果

### 参数
> `method`
>> HTTP方法

> `uri`
>> URI

### 返回值
```
Array
(
    [route] => /admin/user/$id
    
    [callback] => Array
    (
        [0] => App\Admin
        [1] => index
    )
    
    [options] => Array
    (
        [requirements] => Array
        (
            [id] => \d+
        )

        [method] => Array
        (
            [0] => GET
        )
    )

    [parameters] => Array
    (
        [0] => /admin/user/1
        [id] => 1
        [1] => 1
    )
)
```

### 示例
```php
$result = $routing->dispatch('GET', '/admin/user/1');
```
