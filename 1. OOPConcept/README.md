# What is traits, Interface, and Abstract Class?

## ট্রেইটস (Traits)

ট্রেইটস হল PHP তে কোড রিইউজ করার একটি মেকানিজম। এটি ক্লাস এর মধ্যে মেথড এবং প্রপার্টি শেয়ার করার জন্য ব্যবহৃত হয়। একটি ক্লাস একাধিক ট্রেইট ব্যবহার করতে পারে।

```php
trait Logger {
    public function log($message) {
        echo "লগ করা হল: " . $message;
    }
}

class UserController {
    use Logger;
    
    public function store() {
        $this->log("নতুন ইউজার তৈরি করা হল");
    }
}
```

## ইন্টারফেস (Interface)

ইন্টারফেস হল একটি কন্ট্রাক্ট যা ক্লাসগুলোকে কিছু নির্দিষ্ট মেথড ইমপ্লিমেন্ট করতে বাধ্য করে। ইন্টারফেসে শুধু মেথডের ডিক্লারেশন থাকে, ইমপ্লিমেন্টেশন থাকে না।

```php
interface PaymentGateway {
    public function processPayment($amount);
    public function refund($transactionId);
}

class BkashPayment implements PaymentGateway {
    public function processPayment($amount) {
        return "বিকাশে " . $amount . " টাকা পেমেন্ট করা হল";
    }
    
    public function refund($transactionId) {
        return "ট্রানজেকশন " . $transactionId . " রিফান্ড করা হল";
    }
}
```

## অ্যাবস্ট্রাক্ট ক্লাস (Abstract Class)

অ্যাবস্ট্রাক্ট ক্লাস হল এমন একটি ক্লাস যা সরাসরি ইনস্ট্যান্সিয়েট করা যায় না। এটি অন্য ক্লাস দ্বারা এক্সটেন্ড করা হয় এবং এতে কিছু অ্যাবস্ট্রাক্ট মেথড থাকতে পারে যা চাইল্ড ক্লাসে ইমপ্লিমেন্ট করতে হয়।

```go
abstract class Vehicle {
    protected $brand;
    
    abstract public function start();
    
    public function setBrand($brand) {
        $this->brand = $brand;
    }
}

class Car extends Vehicle {
    public function start() {
        return $this->brand . " গাড়ি স্টার্ট করা হল";
    }
}

$car = new Car();
$car->setBrand("টয়োটা");
echo $car->start(); // আউটপুট: টয়োটা গাড়ি স্টার্ট করা হল
```

## মূল পার্থক্য

- **ট্রেইটস:** কোড রিইউজ করার জন্য, মাল্টিপল ট্রেইট ব্যবহার করা যায়
- **ইন্টারফেস:** শুধু মেথড ডিক্লারেশন থাকে, ইমপ্লিমেন্টেশন থাকে না
- **অ্যাবস্ট্রাক্ট ক্লাস:** কমন ফাংশনালিটি শেয়ার করার জন্য, অ্যাবস্ট্রাক্ট ও নন-অ্যাবস্ট্রাক্ট মেথড থাকতে পারে