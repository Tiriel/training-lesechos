<?php

namespace App\PhpC2\ErrorHandler;

use App\PhpC2\Storage\StorageInterface;

class StorageErrorHandler
{
    public function __construct(
        private readonly StorageInterface $storage
    ) {}

    public function __invoke(int $errno, string $errstr, ?string $errfile = null, ?int $errline = null)
    {
        return match ($errno) {
            E_USER_ERROR => $this->formatError('Error', $errstr, $errfile, $errline),
            E_USER_WARNING => $this->formatError('Warning', $errstr, $errfile, $errline),
            E_USER_NOTICE => $this->formatError('Notice', $errstr, $errfile, $errline),
            default => $this->storage->set('default', $errstr)
        };
    }

    private function formatError(string $level, string $errstr, ?string $errfile = null, ?int $errline = null)
    {
        $message = sprintf("Fatal Error! %s : \"%s\"", $level, $errstr);

        if ($errfile) {
            $message .= sprintf(" in file %s", $errfile);
        }
        if ($errline) {
            $message .= sprintf(" at line %d", $errline);
        }

        return $this->storage->set($level, $message);
    }
}
