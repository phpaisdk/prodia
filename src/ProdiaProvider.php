<?php

declare(strict_types=1);

namespace AiSdk\Prodia;

use AiSdk\Contracts\BaseProvider;
use AiSdk\Contracts\ImageModelInterface;
use AiSdk\Contracts\ImageProviderInterface;
use AiSdk\Prodia\Models\ProdiaImageModel;

final class ProdiaProvider extends BaseProvider implements ImageProviderInterface
{
    public function __construct(public readonly ProdiaOptions $options) {} public function name(): string
    {
        return ProdiaOptions::PROVIDER_NAME;
    } protected function imageModel(string $modelId): ImageModelInterface
    {
        return new ProdiaImageModel($modelId, $this->options);
    }
}
