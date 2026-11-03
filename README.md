# PHP AI SDK — Prodia

Image generation with Prodia for the framework-agnostic [PHP AI SDK](https://phpaisdk.com).

## Installation

```bash
composer require aisdk/prodia
```

Set `PRODIA_TOKEN` in your environment.

## Usage

```php
use AiSdk\Generate;
use AiSdk\Prodia;

$result = Generate::image('A mountain lake at sunrise, soft natural light.')
    ->model(Prodia::model('inference.flux-2.pro.txt2img.v1'))
    ->run();

$result->output->save(__DIR__.'/image.png');
```

## Documentation

[Read the documentation](https://phpaisdk.com/docs/0.x/providers/prodia) for configuration, supported features, and more examples.

[Contributing](https://github.com/phpaisdk/.github/blob/main/CONTRIBUTING.md) · [Support](https://github.com/phpaisdk/.github/blob/main/SUPPORT.md)

## License

The MIT License (MIT). See [LICENSE](LICENSE) for details.
