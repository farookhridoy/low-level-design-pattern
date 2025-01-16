**S - Single Responsibility Principle**

**`A Class should have only 1 reason to change.`**

Marker Entity:
Suppose we have a marker entity, there we have name, color, year and price.

```java  
class Marker {  
    String name;  
    String color;  
    int year;  
    int price;  

    public Marker(String name, String color, int year, int price) {  
        this.name = name;  
        this.color = color;  
        this.year = year;  
        this.price = price;  
    }  
}  
````
Now we gonna make a invoice class for that. 
```java
class Invoice {  
    private Marker marker;  
    private int quantity;  

    public Invoice(Marker marker, int quantity) {  
        this.marker = marker;  
        this.quantity = quantity;  
    }  

    public int calculateTotal() {  
        int price = ((marker.price) * this.quantity);  
        return price;  
    }  

    public void printInvoice() {  
        // Print the Invoice  
    }  

    public void saveToDB() {  
        // Save the data into DB  
    }  
}  
```
Here in invoice class we call Marker class. Main responsibility of this class is calculated total. After calculate 
total then return invoice and after that save data to DB. Read this tasks what do thing? is it maintain **single 
responsibility principal?** 
Answer is no. Main goal of **Single Responsibility Principal** is **`A Class should have only 1 reason to change.`** 
But minimum 3 reason to change the class object. 
- I want to add vat/tax then calculateTotal method need to 
modified/change.
- I want to save the invoice to file not db that might be another reason to change this invoice class.

So we can solve this problem and maintain principal to make different class for different job here.

- For calculate total
```java
class Invoice {  
    private Marker marker;  
    private int quantity;  

    public Invoice(Marker marker, int quantity) {  
        this.marker = marker;  
        this.quantity = quantity;  
    }  

    public int calculateTotal() {  
        int price = ((marker.price) * this.quantity);  
        return price;  
    }  
}
```
- Save Invoice
```java
class InvoiceDao{
    Invoice invoice;
    
    public InvoiceDao(Invoice invoice){
        this.invoice = invoice;
    }
    
    public void saveToDB() {  
        // Save the data into DB  
    }  
}

```
- Print Invoice
```java
class InvoicePrinter{
    private Invoice invoice;
    
    public InvoicePrinter(Invoice invoice){
        this.invoice = invoice;
    }
    
    public void print() {  
        // Save the data into DB  
    }  
}
```
- Now each class has single responsibility. Every class has single reason to change. suppose we need to calculate 
  qty then we will change the CalculateInvoice class.

**What we learn from here?**
- Easy to maintain
- Easy to understand