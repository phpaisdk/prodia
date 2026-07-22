<?php

declare(strict_types=1);

namespace AiSdk;

use AiSdk\Contracts\Model;
use AiSdk\Prodia\ProdiaOptions;
use AiSdk\Prodia\ProdiaProvider;

final class Prodia
{
    private static ?ProdiaProvider $default = null;
    /** @param array<string,mixed> $config */ public static function create(array $config = []): ProdiaProvider
    {
        return self::$default = new ProdiaProvider(ProdiaOptions::fromArray($config));
    } public static function default(): ProdiaProvider
    {
        return self::$default ??= self::create();
    } public static function reset(): void
    {
        self::$default = null;
    } public static function model(string $modelId): Model
    {
        return self::default()->model($modelId);
    }
}
