# aisdk/prodia

<a href="https://github.com/phpaisdk/prodia/actions"><img alt="GitHub Workflow Status" src="https://img.shields.io/github/actions/workflow/status/phpaisdk/prodia/tests.yml?branch=main&label=Tests"></a>
<a href="https://packagist.org/packages/aisdk/prodia"><img alt="Latest Version" src="https://img.shields.io/packagist/v/aisdk/prodia"></a>
<a href="https://packagist.org/packages/aisdk/prodia"><img alt="License" src="https://img.shields.io/packagist/l/aisdk/prodia"></a>

------

Official Prodia provider for the PHP AI SDK. Uses Prodia's native synchronous Inference API for image generation.

## Installation

```bash
composer require aisdk/prodia
```

## Basic Usage

```php
use AiSdk\Generate;
use AiSdk\Prodia;

Prodia::create(['apiKey' => $_ENV['PRODIA_TOKEN']]);

$image = Generate::image('A cinematic mountain lake at sunrise')
    ->model(Prodia::model('inference.flux-fast.schnell.txt2img.v2'))
    ->run();
```

## Configuration

| Variable | Description | Default |
| --- | --- | --- |
| `PRODIA_TOKEN` | API token for authentication | Required |
| `PRODIA_BASE_URL` | Base URL for API requests | `https://inference.prodia.com` |

## Supported Capabilities

| Capability | Support |
| --- | --- |
| Text-to-image generation | Native synchronous `/v2/job` |
| Seed | Portable SDK option |
| Native job configuration | `providerOptions` |

The package requests an image response from Prodia's synchronous `/v2/job` endpoint. Use `providerOptions('prodia', ['config' => [...], 'raw' => [...]])` for native job configuration and request fields.

## Documentation

- [Prodia Inference API documentation](https://docs.prodia.com/reference/inference/)
- [PHP AI SDK documentation](https://phpaisdk.com/docs/prodia)
