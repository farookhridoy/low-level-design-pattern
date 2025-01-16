**I - Interface Segment Principal**

**Interface should be such, that client should not implement unnecessary functions they do not need.**

**Example:**

```java

interface RestaurantEmployee {  
    void washDishes();  
    void serveCustomers();  
    void cookFood();  
}  

class waiter implements RestaurantEmployee {  
    public void washDishes() {  
        // not my job  
    }  

    public void serveCustomers() {  
        // yes and here is my implementation  
        System.out.println("serving the customer");  
    }  

    public void cookFood() {  
        // not my job  
    }  
}

```

**Understanding Problem:** 

- Here `Waiter` implement `RestaurantEmployee` interface, and he needs to implement the washDishes and other method. But is that the waiter responsibility to do food cook or washDishes ?
- Answer is no. This is break Interface Segment Principal.

**Solutions:**
- Segmented means divided the large interface to smaller so that client doesn't need to implement unnecessary code.

```java

interface WaiterInterface {  
    void serveCustomers();  
    void takeOrder();  
}  

interface ChefInterface {  
    void cookFood();  
    void decideMenu();  
}
```

- We break the interface into two `WaiterInterface`
  `ChefInterface` interface.
- Waiter job is server customer and take order. not cook food or decideMenu those are Chef work.
```java
class waiter implements WaiterInterface {  
    
    public void serveCustomers() {  
        System.out.println("serving the customer");  
    }  
    
    public void takeOrder() {  
        System.out.println("taking orders");  
    }  
}

class chef implements ChefInterface {  
    
    public void cookFood() {  
        System.out.println("cook the food");  
    }  
    
    public void decideMenu() {  
        System.out.println("decide the menu");  
    }  
}

```