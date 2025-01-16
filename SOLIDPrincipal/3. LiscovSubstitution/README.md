**L - Liskov Substitution Principal**

- **if Class B is subtype of Class A, then we should be able to replace object of "A" with "B" without breaking the behavior of the program.**
- **Subclass should extend the capability of parent class not narrow it down.**

> Example: 

```
interface Bike {  
    void turnOnEngine();  
    void accelerate();  
}  

class MotorCycle implements Bike {  
    boolean isEngineOn;  
    int speed;  

    public void turnOnEngine() {  
        // turn on the engine!  
        isEngineOn = true;  
    }  

    public void accelerate() {  
        // increase the speed  
        speed = speed + 10;  
    }  
}
```

- Suppose we have a interface of Bike there have two method "turnOnEngine" & "accelerate". Now have MotorCycle class which implement Bike Interface and use implement the functionality.
- Now if we make another class name ByCycle and implement the Bike interface what we face? 
```
interface Bike {  
    void turnOnEngine();  
    void accelerate();  
}  

class MotorCycle implements Bike {  
    boolean isEngineOn;  
    int speed;  

    public void turnOnEngine() {  
       throw new AssertationError('There is no engine');
    }  

    public void accelerate() {  
        // increase the speed  
        speed = speed + 5;  
    }  
}
```
**Violation of LSP:**

- The Bike interface assumes all bikes have an engine by requiring the turnOnEngine method.
 - This assumption does not hold true for all types of bikes, such as bicycles, which do not have engines.
   - If a ByCycle class implements the Bike interface, it would either:
   - Leave the turnOnEngine method unimplemented, leading to errors.
   - Implement the method with irrelevant or nonsensical behavior (e.g., throwing an exception), which breaks the LSP.
   
**Why This Violates LSP:**

- The LSP states that subclasses should be substitutable for their parent classes without altering the program's correctness.
- A ByCycle cannot be substituted where a Bike is expected, as it does not support the full behavior of the Bike interface.

**Solution: Refactor the Design**
- To adhere to the LSP, we should:

- Separate the Concerns: Use more specific interfaces to reflect different kinds of bikes.
- Avoid Forcing Irrelevant Methods: Each subclass should implement only the functionality relevant to it.


**Refactored Design**
**Step 1: Define a More General Interface**
```java
interface Vehicle {
    void accelerate();
}
```
**Step 2: Define Specific Interfaces for Engine-Based Vehicles**
```java
interface EnginePoweredVehicle extends Vehicle {
    void turnOnEngine();
}
```
**Step 3: Implement the Interfaces in the Appropriate Classes**

```java

// MotorCycle is an engine-powered vehicle

class MotorCycle implements EnginePoweredVehicle {
    boolean isEngineOn;
    int speed;

    @Override
    public void turnOnEngine() {
        // Turn on the engine
        isEngineOn = true;
    }

    @Override
    public void accelerate() {
        if (isEngineOn) {
            // Increase the speed
            speed = speed + 10;
        } else {
            throw new IllegalStateException("Engine is not on!");
        }
    }
}

// ByCycle is not engine-powered

class ByCycle implements Vehicle {
    int speed;
    @Override
    public void accelerate() {
        // Increase the speed
        speed = speed + 5;
    }
}
```

**Benefits of the Refactored Design**
**Adherence to LSP:**
- A MotorCycle can still be substituted for an EnginePoweredVehicle or a Vehicle.
- A ByCycle can be substituted for a Vehicle without implementing irrelevant methods.

**Flexibility:**
  - The Vehicle interface allows for future extensions, such as electric scooters, without forcing all vehicles to implement irrelevant methods.

**Clean Design:**
  - Each class implements only the behavior that makes sense for it, avoiding unnecessary complexity and potential bugs.