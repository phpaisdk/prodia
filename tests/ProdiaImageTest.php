<?php

declare(strict_types=1);
use AiSdk\Generate;
use AiSdk\Prodia;
use AiSdk\Support\Sdk;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

it('runs a Prodia v2 synchronous image job', function (): void {
    $client = new class implements ClientInterface {
        public ?RequestInterface $request = null;
        public function sendRequest(RequestInterface $request): ResponseInterface
        {
            $this->request = $request;
            return new Response(200, ['Content-Type' => 'image/png'], 'png-bytes');
        }
    };
    $f = new Psr17Factory();
    Generate::configure(new Sdk($client, $f, $f));
    Prodia::create(['apiKey' => 'prodia-test']);
    $result = Generate::image('A kite')->model(Prodia::model('inference.flux-fast.schnell.txt2img.v2'))->run();
    $body = json_decode((string) $client->request?->getBody(), true);
    expect($result->output->base64)->toBe(base64_encode('png-bytes'))->and((string) $client->request?->getUri())->toBe('https://inference.prodia.com/v2/job')->and($client->request?->getHeaderLine('Authorization'))->toBe('Bearer prodia-test')->and($body['config']['prompt'])->toBe('A kite');
});
