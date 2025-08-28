# Finite State Machine (FSM)

## Installation

1. Install the package via Composer:

    `composer require fedman2010/fsm`

2. Include the Composer autoloader in your PHP script:

    `include __DIR__ . '/vendor/autoload.php';` to your code.

## Usage

### Step 1: Create the configuration:

Define the FSM configuration as an associative array with an initial_state and a rules array that specifies state transitions.Example configuration:
```
$config = [
    'initial_state' => 'idle',
    'rules' => [
        'idle' => [
            [
                'next' => 'running',
                'value' => 'start'
            ],
            [
                'next' => 'stopped',
                'value' => 'stop'
            ]
        ],
        'running' => [
            [
                'next' => 'stopped',
                'value' => 'stop'
            ]
        ],
        'stopped' => [
            [
                'next' => 'idle',
                'value' => 'reset'
            ]
        ]
    ]
];
```
* `initial_state`: The starting state of the FSM (string).
* `rules`: An array where:
    * Keys are state names (string).
    * Values are arrays of transition rules, each containing:
        * `next`: The target state to transition to (string).
        * `value`: The input value that triggers the transition (string or integer).


### Step 2: Initialize the FSM

Create an instance of the FSM with the configuration:

```
use Fedman2010\Fsm\FSM;

$fsm = new FSM($config);
```

### Step 3: Perform Transitions

Use the `transition` method to move between states based on input values:
```
$newState = $fsm->transition('start'); // Transitions to 'running' if current state is 'idle'
echo $newState; // Outputs: running
```

## Example

See the `example1.php` and `example2.php` files in the repository for complete, working examples of how to use the FSM.To run the examples in the console, execute:

```
php -f example1.php
php -f example2.php
```
