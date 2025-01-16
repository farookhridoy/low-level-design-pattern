**Strategy Design Pattern**
The Strategy Design Pattern is a behavioral design pattern that defines a family of algorithms, encapsulates each one, and makes them interchangeable. This allows the algorithm to vary independently of clients that use it.

**Key Components:**
   - **Context**: Maintains a reference to a strategy object.
   - **Strategy Interface**: Common interface for all supported algorithms.
   - **Concrete Strategies**: Implement the strategy interface for specific behaviors.

**When to Use:**

**The Strategy Pattern is ideal for scenarios where:**

- You want to define multiple algorithms or behaviors and switch between them dynamically.

- You want to avoid conditional statements (e.g., if-else or switch) for selecting behaviors.

- You want to decouple the logic of an algorithm from the object that uses it.

- Different behaviors apply to different instances of the same class or family of classes.

**Example**
```php

<?php

// Strategy Interface
interface MoveStrategy {
    public function move(): string;
}

// Concrete Strategies
class NormalMove implements MoveStrategy {
    public function move(): string {
        return "Moving at normal speed.";
    }
}

class FastMove implements MoveStrategy {
    public function move(): string {
        return "Moving at fast speed!";
    }
}

class NoMove implements MoveStrategy {
    public function move(): string {
        return "This vehicle does not move.";
    }
}

// Base Class
abstract class Vehicle {
    protected $moveStrategy;

    public function __construct(MoveStrategy $moveStrategy) {
        $this->moveStrategy = $moveStrategy;
    }

    public function setMoveStrategy(MoveStrategy $moveStrategy) {
        $this->moveStrategy = $moveStrategy;
    }

    public function performMove(): string {
        return $this->moveStrategy->move();
    }

    abstract public function getType(): string;
}

// Subclasses
class Bike extends Vehicle {
    public function getType(): string {
        return "Bike";
    }
}

class Car extends Vehicle {
    public function getType(): string {
        return "Car";
    }
}

class SuperCar extends Vehicle {
    public function getType(): string {
        return "SuperCar";
    }
}

// Usage
$bike = new Bike(new NormalMove());
echo $bike->getType() . ": " . $bike->performMove() . PHP_EOL;

$car = new Car(new FastMove());
echo $car->getType() . ": " . $car->performMove() . PHP_EOL;

$superCar = new SuperCar(new FastMove());
echo $superCar->getType() . ": " . $superCar->performMove() . PHP_EOL;

// Change strategy at runtime
$superCar->setMoveStrategy(new NoMove());
echo $superCar->getType() . ": " . $superCar->performMove() . PHP_EOL;


```

**Explanation**:
- MoveStrategy Interface: Defines the common interface for move behaviors.
  - Concrete Strategies:
  - NormalMove: For vehicles moving at normal speed.
  - FastMove: For high-speed movement.
  - NoMove: For vehicles that cannot move.

- **Vehicle Abstract Class:**
- Base class with a reference to the MoveStrategy.
- Allows dynamic assignment of move behaviors using setMoveStrategy().

**Concrete Vehicles:**
- Bike, Car, and SuperCar inherit from the Vehicle class.

## **Comparison with Other Approaches**

Here’s how the Strategy Pattern compares with other design approaches:

| **Approach**         | **Use Case**                                                                                    |
| -------------------- | ----------------------------------------------------------------------------------------------- |
| **Inheritance**      | If all or most child classes share the same functionality, move it to the base class.           |
| **Traits**           | If only some child classes share functionality, use a PHP **trait** for reusability.            |
| **Composition**      | When you want to avoid rigid inheritance and share functionality across unrelated classes.      |
| **Strategy Pattern** | When behavior needs to change dynamically or when you want to decouple algorithms from classes. |


## **When Not to Use**

- If behaviors don’t change dynamically or aren’t complex, the Strategy Pattern might add unnecessary complexity.
- If child classes only share simple, static behavior, consider using inheritance, traits, or composition instead.
