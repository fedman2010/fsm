<?php

namespace Fedman2010\Fsm;

use InvalidArgumentException;

class FSM
{
    private $initialState;
    private $currentState;
    private $rules;

    public function __construct(array $config)
    {
        // validate config
        if (empty($config['initial_state']) || empty($config['rules'])) {
            throw new InvalidArgumentException('Invalid FSM configuration');
        }
        if (!in_array($config['initial_state'], array_keys($config['rules']))) {
            throw new InvalidArgumentException('Initial state must be one of the defined states');
        }

        $this->initialState = $config['initial_state'];
        $this->currentState = $this->initialState;
        $this->rules = $config['rules'];
    }

    public function transition(int|string $input): ?string
    {
        $transitions = $this->rules[$this->currentState] ?? [];
        foreach ($transitions as $transition) {
            if ($transition['value'] === $input) {
                $this->currentState = $transition['next'];
                return $this->currentState;
            }
        }
        return null;
    }

    public function getCurrentState(): string
    {
        return $this->currentState;
    }

    public function reset(): void
    {
        $this->currentState = $this->initialState;
    }
}
