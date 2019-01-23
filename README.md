<h1 align="center">Map</h1>

## 运行环境

- php >= 7.0
- composer
- laravel >= 5.6

## 安装

```Shell
$ composer require MobileNowGroup/laravel-map
```

### 配置文件

```Shell
$ php artisan vendor:publish --provider="MobileNowGroup\\LaravelMap\\MapServiceProvider" --tag=laravel-map
```

随后，请在 `config` 文件夹中完善配置信息。

`.env` 文件里面配置

```PHP
// map 配置
MAP_PROVIDER=
MAP_KEY=
```

## License

MIT