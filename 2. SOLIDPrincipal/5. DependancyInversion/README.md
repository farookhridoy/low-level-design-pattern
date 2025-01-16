**D - Dependency Inversion Principal**

**Class Should be depended on interface not the concrete classes.**

**Example:**

```java

class MacBook {  
    private final WiredKeyboard keyboard;  
    private final WiredMouse mouse;  

    public MacBook() {  
        keyboard = new WiredKeyboard();  
        mouse = new WiredMouse();  
    }  
}
```

**Understanding the Problem:**
  - The Dependency Inversion Principle (DIP) states that high-level modules should not depend on low-level modules but on abstractions (e.g., interfaces).
  - It promotes flexibility and easier maintenance by decoupling classes.

- The provided code violates DIP because the MacBook class depends directly on the WiredKeyboard and WiredMouse implementations.
- If we need to use a different keyboard or mouse type, we must modify the MacBook class, which is inflexible and violates open-closed principle too

**Improved Example with Interface:**
`We introduce interfaces for Keyboard and Mouse, allowing the MacBook class to depend on abstractions rather than concrete implementations.`

```java
// Define interfaces
interface Keyboard {
    void type();
}

interface Mouse {
    void click();
}

// Implementations of the interfaces
class WiredKeyboard implements Keyboard {
    @Override
    public void type() {
        System.out.println("Typing using a Wired Keyboard");
    }
}

class WirelessKeyboard implements Keyboard {
    @Override
    public void type() {
        System.out.println("Typing using a Wireless Keyboard");
    }
}

class WiredMouse implements Mouse {
    @Override
    public void click() {
        System.out.println("Clicking using a Wired Mouse");
    }
}

class WirelessMouse implements Mouse {
    @Override
    public void click() {
        System.out.println("Clicking using a Wireless Mouse");
    }
}

// MacBook class depends on abstractions
class MacBook {
    private final Keyboard keyboard;
    private final Mouse mouse;

    public MacBook(Keyboard keyboard, Mouse mouse) {
        this.keyboard = keyboard;
        this.mouse = mouse;
    }

    public void useMacBook() {
        keyboard.type();
        mouse.click();
    }
}

// Test the code
public class Main {
    public static void main(String[] args) {
        // Use wired devices
        Keyboard wiredKeyboard = new WiredKeyboard();
        Mouse wiredMouse = new WiredMouse();
        MacBook macBook1 = new MacBook(wiredKeyboard, wiredMouse);
        macBook1.useMacBook();

        // Use wireless devices
        Keyboard wirelessKeyboard = new WirelessKeyboard();
        Mouse wirelessMouse = new WirelessMouse();
        MacBook macBook2 = new MacBook(wirelessKeyboard, wirelessMouse);
        macBook2.useMacBook();
    }
}


```