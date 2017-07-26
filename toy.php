<?php
declare(strict_types=1);

function acceptsInt(int $n) {
}

function returnsFloat(): float{
  return 2.3;
}

acceptsInt(returnsFloat());
