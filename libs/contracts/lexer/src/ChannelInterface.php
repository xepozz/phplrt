<?php

declare(strict_types=1);

namespace Phplrt\Contracts\Lexer;

interface ChannelInterface
{
    /**
     * Returns the channel name.
     *
     * Can be used for custom token channels.
     *
     * @return non-empty-string
     */
    public function getName(): string;
}
