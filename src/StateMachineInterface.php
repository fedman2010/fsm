<?php

namespace Fedman2010\Fsm;

interface StateMachineInterface
{
    public function transition(int|string $input): ?string;
    public function getCurrentState(): string;
    public function reset(): void;
}
