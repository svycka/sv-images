# svycka/sv-images

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

Image manipulation library written in PHP, similar to cloud image processing services like [Imgix](http://www.imgix.com/) and [Cloudinary](http://cloudinary.com/). This module simplifies image manipulation for Zend Framework 2


## Install

Via Composer

``` bash
$ composer require svycka/sv-images
```

## Basic Usage

- Register `SvImages` as module in `config/application.config.php`
- Create filesystem factory, exmaple:
```php
class ImageFilesystemFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $flysystem = new \League\Flysystem\Filesystem(new Local(__DIR__.'/path/to/files'));
        $adapter = new \SvImages\Filesystem\Adapter\FlySystemAdapter($flysystem);
        return new \SvImages\Filesystem\Filesystem($adapter);
    }
}
```
- Create cache storage, for best performance should point to public directory, so once cache is generated PHP will not be hit at all, example:
```php
class ImageCacheStorageFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $flysystem = new \League\Flysystem\Filesystem(new Local(__DIR__.'/path/to/public'));
        return new \SvImages\Cache\FlySystemStorage($flysystem);
    }
}
```
- Copy the file located in `vendor/svycka/sv-images/config/images.global.php.dist` to `config/autoload/images.global.php` and change the values as you wish
- Test it by going to http://example.com/image/crop,x15,y15,w300,h300/fit,w200,h150,top-left/f_key/your-image.jpg

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Credits

- [Vytautas Stankus][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/svycka/sv-images.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/svycka/sv-images.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/svycka/sv-images
[link-downloads]: https://packagist.org/packages/svycka/sv-images
[link-author]: https://github.com/svycka
[link-contributors]: https://github.com/svycka/sv-images/graphs/contributors
