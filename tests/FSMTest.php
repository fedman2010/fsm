<?php

final class FSMTest extends \PHPUnit\Framework\TestCase
{
    private array $config;

    protected function setUp(): void
    {
        $this->config = [
            'initial_state' => 'S0',
            'rules' => [
                'S0' => [
                    [
                        'next' => 'S1',
                        'value' => '1'
                    ],
                    [
                        'next' => 'S0',
                        'value' => '0'
                    ]
                ],
                'S1' => [
                    [
                        'next' => 'S0',
                        'value' => '1'
                    ],
                    [
                        'next' => 'S2',
                        'value' => '0'
                    ]
                ],
                'S2' => [
                    [
                        'next' => 'S2',
                        'value' => '1'
                    ],
                    [
                        'next' => 'S1',
                        'value' => '0'
                    ]
                ]
            ]
        ];
    }

    public function testCanTransitionBetweenStates()
    {
        $fsm = new \Fedman2010\Fsm\FSM($this->config);

        $fsm->reset();
        $this->assertEquals('S0', $fsm->getCurrentState());
        $fsm->transition('1');
        $this->assertEquals('S1', $fsm->getCurrentState());
        $fsm->transition('0');
        $this->assertEquals('S2', $fsm->getCurrentState());
    }

    public function testInvalidTransitionReturnsNull()
    {
        $fsm = new \Fedman2010\Fsm\FSM($this->config);

        $fsm->reset();
        $this->assertEquals('S0', $fsm->getCurrentState());
        $result = $fsm->transition('2'); // Invalid input
        $this->assertNull($result);
        $this->assertEquals('S0', $fsm->getCurrentState()); // State should remain unchanged
    }

    public function testResetFunctionality()
    {
        $fsm = new \Fedman2010\Fsm\FSM($this->config);

        $fsm->reset();
        $this->assertEquals('S0', $fsm->getCurrentState());
        $fsm->transition('1');
        $this->assertEquals('S1', $fsm->getCurrentState());
        $fsm->reset();
        $this->assertEquals('S0', $fsm->getCurrentState());
    }

    public function testInitialStateValidation()
    {
        $this->expectException(InvalidArgumentException::class);
        $invalidConfig = $this->config;
        $invalidConfig['initial_state'] = 'InvalidState';
        new \Fedman2010\Fsm\FSM($invalidConfig);
    }
}
