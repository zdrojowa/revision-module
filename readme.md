# RevisionModule

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

Revisions & History

## Installation

Via Composer

``` bash
$ composer require zdrojowa/revision-module
```

## Usage
- Add in webpack.mix.js

``` bash
mix.module('RevisionModule', 'vendor/zdrojowa/revision-module');
```

- Add module RevisionModule in config/selene.php

``` bash
'modules' => [
    RevisionModule::class,
],
```

- run npm

``` bash
npm install
npm run prod
```

- Dodaj w module akcji

``` bash
Revision::create([
    'table' => 'pages',
    'action' => 'updated',
    'content_id' => $id,
    'content' => $page,
    'created_at' => now(),
    'user_id' => $request->user()->id
]);
```

- Dodaj we view

``` bash
@include('RevisionModule::revisions', [
    'revisions' => $revisions ?? null
])
```

- Dodaj w Controller
   
``` bash
'revisions' => Revision::query()->where('table', '=', 'pages')
    ->where('content_id', '=', $page->_id)
    ->orderByDesc('_id')
    ->limit(50)
    ->get()
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [author name][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/zdrojowa/revision-module.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/zdrojowa/revision-module.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/zdrojowa/revision-module/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/zdrojowa/revision-module
[link-downloads]: https://packagist.org/packages/zdrojowa/revision-module
[link-travis]: https://travis-ci.org/zdrojowa/revision-module
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/zdrojowa
[link-contributors]: ../../contributors
