<?php

declare(strict_types=1);

namespace App\Api\Helpers;

final class RedisReader
{
  public function resolve (string $q): ?string
  {
    switch ($q) {
      case 'help':
      case 'toto':
      case 'test':
        return 'Help found';
      default:
        return null;
    }
  }
}
