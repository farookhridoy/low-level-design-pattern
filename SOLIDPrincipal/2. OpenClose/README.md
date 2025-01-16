**O - Open Close Principle**

**`Open for extension but close for modification.`**

- Suppose you have a class where you save the file to db. This function is now working fine, and it's deployed to live server.
- Now you want to add another feature to save to file. 

```java
class InvoiceDao{
    Invoice invoice;
    
    public InvoiceDao(Invoice invoice){
        this.invoice = invoice;
    }
    
    public void saveToDB() {  
        // Save the data into DB  
    }  
    
    public void saveToFile() {  
        // Save the data into FIle  
    }  
}

```
- But this is break the law of open close principal. So how can we soled this? 
- **Solutions:** 
  - We can make a interface like save and extend this interface for each time while we need to developed new feature.
  
```java
    interface InvoiceDao {  
        void save(Invoice invoice);  
    }

    class DatabaseInvoiceDao implements InvoiceDao {  
        @Override  
        public void save(Invoice invoice) {  
            // Save to DB  
        }  
    }
    
    class FileInvoiceDao implements InvoiceDao {  
        @Override  
        public void save(Invoice invoice) {  
            // Save to file  
        }  
    }
    
    // Example of Factory Pattern
    class InvoiceDaoFactory {
        public static InvoiceDao getInvoiceDao(String type) {
            if (type.equalsIgnoreCase("database")) {
                return new DatabaseInvoiceDao();
            } else if (type.equalsIgnoreCase("file")) {
                return new FileInvoiceDao();
            } 
            throw new IllegalArgumentException("Invalid DAO type");
        }
    }
    
    //Usages
    public class Main {
        public static void main(String[] args) {
            Invoice invoice = new Invoice();
    
            // Dynamically choose the DAO type
            InvoiceDao invoiceDao = InvoiceDaoFactory.getInvoiceDao("database");
            invoiceDao.save(invoice);
    
            InvoiceDao fileInvoiceDao = InvoiceDaoFactory.getInvoiceDao("file");
            fileInvoiceDao.save(invoice);
        }
    }

```

- Define an interface InvoiceDao that declares the save method. This ensures that different implementations can be created without altering the existing class.
- Each new functionality (e.g., saving to a database or file) is encapsulated in a separate class that implements the InvoiceDao interface.

**Benefits**
- **Scalability**: Adding a new saving mechanism (e.g., saving to a remote server) only requires implementing the InvoiceDao interface and updating the factory if needed.
- **Flexibility**: The client code remains unaware of the actual implementation, relying only on the InvoiceDao interface.
- **Adherence to OCP**: No existing class is modified; new features are added by extending the system.

- This design is clean, modular, and aligns perfectly with SOLID principles, particularly the **Open/Closed** Principle.