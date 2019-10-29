# Tables

[![Latest Version on Packagist](https://img.shields.io/packagist/v/brilliant-code/table.svg?style=flat-square)](https://packagist.org/packages/brilliant-code/:package_name)
[![Build Status](https://img.shields.io/travis/brilliant-code/table/master.svg?style=flat-square)](https://travis-ci.org/brilliant-code/:package_name)
[![Quality Score](https://img.shields.io/scrutinizer/g/brilliant-code/table.svg?style=flat-square)](https://scrutinizer-ci.com/g/brilliant-code/:package_name)
[![Total Downloads](https://img.shields.io/packagist/dt/brilliant-code/table.svg?style=flat-square)](https://packagist.org/packages/brilliant-code/:package_name)


Features:
- Easily create tables/data reports/exports
- Support multiple formats (CSV, HTML)
- Usable for data export with custom business logic

## Installation

You can install the package via composer:

```bash
composer require brilliant-code/table
```

## Usage

Imagine you need to build this table:
```bash
+---------+----------------+----------+
|  Count  |                |    3     |
+---------+----------------+----------+
| John    | john@mail.com  | pwdjohn  |
| Mike    | mike@mail.com  | mikepwd  |
| Another | another@my.com | password |
+---------+----------------+----------+
```

Write the following Table-class:

``` php
final class UsersTable extends Table
{
    /** @var User[] */
    private $users;

    public function query(): array
    {
        return [
            'users' => User::withCount()->get(),
        ];
    }

    /**
     * Allowed sources to display
     */
    public function sources(): array
    {
        return [CsvSource::class, HtmlSource::class];
    }

    public function handle(Source $source)
    {
        $users = $this->users;
        $source->addRow(['Count', '', $users->count]);
        foreach ($users as $user){
            $source->addRow([$user->name, $user->email, $user->password]);
        }
        return $source;
    }
}

// And Usage:

echo (new UsersTable)->display(HtmlSource::class);
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Pull requests are welcome. Thank you :)

## Credits

- [Ostap](https://github.com/osbre)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
