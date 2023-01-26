<?php

namespace App\PhpC2\Patterns;

class StepIterator implements \Iterator
{
    protected int $position = 0;

    public function __construct(
        protected readonly iterable $data,
        protected readonly int $step = 1
    ) {}

    public function current(): mixed
    {
        return $this->data[$this->position];
    }

    public function next(): void
    {
        $this->position += $this->step;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->data[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function __invoke(): \Generator
    {
        foreach ($this as $key => $value) {
            yield $key => $value;
        }
    }
}

//$data = range(1, 100);
//
//$iterator = new StepIterator($data, 3);
//
//foreach ($iterator() as $k => $v) {
//    echo $k . " => ".$v;
//}
