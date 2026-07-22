<?php

declare(strict_types=1);

namespace AiSdk\Prodia\Models;

use AiSdk\Contracts\BaseModel;
use AiSdk\Contracts\ImageModelInterface;
use AiSdk\Prodia\ProdiaOptions;
use AiSdk\Requests\ImageRequest;
use AiSdk\Responses\ImageResponse;
use AiSdk\Results\ImageData;
use AiSdk\Utils\Support\Url;

final class ProdiaImageModel extends BaseModel implements ImageModelInterface
{
    public function __construct(private readonly string $modelId, private readonly ProdiaOptions $options) {} public function provider(): string
    {
        return ProdiaOptions::PROVIDER_NAME;
    } public function modelId(): string
    {
        return $this->modelId;
    } public function generate(ImageRequest $request): ImageResponse
    {
        $options = $request->providerOptionsFor($this->provider());
        $config = array_replace(['prompt' => $request->prompt], is_array($options['config'] ?? null) ? $options['config'] : []);
        if ($request->seed !== null) {
            $config['seed'] = $request->seed;
        } $body = array_replace(['type' => $this->modelId,'config' => $config], is_array($options['raw'] ?? null) ? $options['raw'] : []);
        $response = $this->runner($this->options->sdk)->postRaw(Url::joinPath($this->options->baseUrl, '/v2/job'), $body, array_replace(['Accept' => 'image/png'], $this->options->authHeaders()), $this->provider());
        return new ImageResponse([new ImageData(base64: base64_encode((string) $response->getBody()), mimeType: $response->getHeaderLine('Content-Type') ?: 'image/png')], rawResponse: [], providerMetadata: ['prodia' => ['model' => $this->modelId]]);
    }
}
