# Comparable-Filesystem

[![Author](http://img.shields.io/badge/author-@fschmengler-blue.svg?style=flat-square)](https://twitter.com/fschmengler)
[![Latest Version](https://img.shields.io/github/release/schmengler/comparable-filesystem.svg?style=flat-square)](https://github.com/schmengler/comparable-filesystem/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/schmengler/comparable-filesystem/master.svg?style=flat-square)](https://travis-ci.org/schmengler/comparable-fileystem)

This package provides Comparators for the file system, i.e. for SplFileInfo objects.
They can be used with the sorting and comparing tools in the [Comparable](https://github.com/schmengler/Comparator-Tools) package.

## Requirements

The package requires PHP 5.4 or later and the Comparable package in version 1.0 or later.

## Install

Via Composer

``` bash
$ composer require sgh/comparable-filesystem
```

## Usage

The following comparators are available:

- FileATimeComparator
- FileCTimeComparator
- FileMTimeComparator
- FileNameComparator
- FileSizeComparator
- FileTypeComparator

You can use all the methods in `\SGH\Comparable\SortFunctions` and `\SGH\Comparable\SetFunctions` with the comparators.
If you prefer, you can also use the factory method `::callback()` to retrieve a comparison callback, that can be used 
in any function that expects a user defined comparison callback:

    usort($arrayOfFiles, \SGH\Comparable\Filesystem\Comparator\FileSizeComparator::callback());

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email fschmengler@sgh-it.eu instead of using the issue tracker.

## Credits

- Fabian Schmengler(https://github.com/schmengler)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.