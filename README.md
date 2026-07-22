# Black Forest Labs provider for PHP AI SDK

```bash
composer require aisdk/prodia
```

```php
use AiSdk\Prodia;
use AiSdk\Generate;

Prodia::create(['apiKey' => $_ENV['PRODIA_TOKEN']]);
$image = Generate::image('A cinematic mountain lake at sunrise')
    ->model(Prodia::model('flux-2-pro-preview'))
    ->size('1440x810')
    ->run();
```

This provider submits a native FLUX request to BFL, polls the returned `polling_url`, and returns BFL’s signed image URL. See [BFL’s image-generation docs](https://docs.bfl.ai/flux_2/flux2_text_to_image).
