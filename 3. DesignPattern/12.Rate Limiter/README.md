# Laravel API Rate Limiting

## Overview
Rate limiting is crucial for protecting APIs from abuse, preventing excessive requests from overwhelming the server, and ensuring fair usage among users. Laravel provides built-in support for rate limiting using middleware, cache, and Redis. This document explains different rate-limiting algorithms and their implementations in Laravel.

## **Rate Limiting Algorithms**

### **1. Token Bucket Algorithm (Using Laravel Throttle Middleware)**
Laravel's `throttle` middleware acts like a **Token Bucket** mechanism.

#### **Implementation in `routes/api.php`**
```php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:10,1'])->group(function () {
    Route::get('/data', function () {
        return response()->json(['message' => 'Success']);
    });
});
```

#### **Explanation**
- `throttle:10,1` → Allows **10 requests per minute** per user.
- Once the limit is exceeded, a **429 Too Many Requests** response is returned.

### **2. Leaky Bucket Algorithm (Using Queue & Delayed Processing)**
This algorithm ensures smooth request processing by delaying excess requests.

#### **Implementation**
1. **Create a Job:**
```bash
php artisan make:job ProcessApiRequest
```

2. **Modify the Job in `app/Jobs/ProcessApiRequest.php`**
```php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessApiRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        sleep(1); // Processing delay
    }
}
```

3. **Dispatch the Job in Controller:**
```php
use App\Jobs\ProcessApiRequest;
use Illuminate\Http\Request;

public function handleApi(Request $request)
{
    ProcessApiRequest::dispatch();
    return response()->json(['message' => 'Request Queued']);
}
```

### **3. Fixed Window Algorithm (Using Cache)**
Requests are limited within a fixed time window.

#### **Implementation**
```php
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

public function fixedWindowRateLimit(Request $request)
{
    $key = 'rate_limit_' . $request->ip();
    $limit = 10;
    $window = 60;

    $current = Cache::get($key, 0);

    if ($current >= $limit) {
        return response()->json(['message' => 'Rate limit exceeded'], 429);
    }

    Cache::put($key, $current + 1, now()->addSeconds($window));

    return response()->json(['message' => 'Request allowed']);
}
```

### **4. Sliding Window Algorithm (Using Redis)**
This method provides a more accurate rate limit by dynamically removing old requests.

#### **Implementation**
```php
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

public function slidingWindowRateLimit(Request $request)
{
    $key = 'sliding_rate_limit_' . $request->ip();
    $limit = 10;
    $window = 60;

    $now = microtime(true) * 1000;
    Redis::zremrangebyscore($key, '-inf', $now - ($window * 1000));

    $count = Redis::zcard($key);

    if ($count >= $limit) {
        return response()->json(['message' => 'Rate limit exceeded'], 429);
    }

    Redis::zadd($key, $now, $now);
    Redis::expire($key, $window);

    return response()->json(['message' => 'Request allowed']);
}
```

### **5. Sliding Window Counter (Using Cache & Time Check)**
A simple yet efficient method using Laravel's cache system.

#### **Implementation**
```php
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

public function slidingWindowCounter(Request $request)
{
    $key = 'sliding_counter_' . $request->ip();
    $limit = 10;
    $window = 60;

    $timestamps = Cache::get($key, []);

    $timestamps = array_filter($timestamps, function ($timestamp) use ($window) {
        return $timestamp > now()->subSeconds($window)->timestamp;
    });

    if (count($timestamps) >= $limit) {
        return response()->json(['message' => 'Rate limit exceeded'], 429);
    }

    $timestamps[] = now()->timestamp;
    Cache::put($key, $timestamps, $window);

    return response()->json(['message' => 'Request allowed']);
}
```

## **Comparison of Algorithms**

| Algorithm | Pros | Cons |
|-----------|------|------|
| **Token Bucket** | Allows burst requests but enforces overall rate limit | Can be complex to tune refill rate |
| **Leaky Bucket** | Smooth request processing | Requests may be delayed |
| **Fixed Window** | Simple to implement | Users can exploit reset times |
| **Sliding Window** | More accurate rate limiting | Requires Redis for efficiency |
| **Sliding Window Counter** | Prevents sudden spikes | Slightly more overhead than fixed window |

## **Final Thoughts**
- If you need a simple approach, **use Laravel's built-in throttle middleware (Token Bucket)**.
- If you need precise control, **use Redis for Sliding Window**.
- If your API has high traffic, **use queues for Leaky Bucket**.

Would you like help integrating this into an existing Laravel project? 🚀

