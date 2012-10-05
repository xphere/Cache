BCC\Cache
=========

This library provides a unified set of tools for common caching tasks.

Storage
-------
You want to store your cached data somewhere, and this is where `StorageInterface` comes handy.

Its only job is to create Items from keys through the `getItem($key)` method.

Some implementations of this interface are:

- `FilesystemStorage`
- `MemoryStorage`
- `DoctrineCacheAdapter`

Item
----
Items allow management of ONE key inside a given Storage. You can:

- `key()`: Get the item's key
- `get()`: Get its cached value (if not missed the cache)
- `set($value)`: Set the cached value
- `miss()`: Check if it missed the cache
- `remove()`: Clear it

### Example

    function cacheComplexFunction(ItemInterface $item, Closure $complex)
    {
        if ($item->miss()) {
            $value = $complex($item->key());
            $item->set($value);
        }
        return $item->get();
    }

    $storage = new MemoryStorage();
    $result = cacheComplexFunction($storage->getItem('key'), complexCalculation);

Cache
-----
The main brain is `Cache`, a concrete class which receives a `StorageInterface` (and optionally a `StrategyInterface`) to proxy all requests through it. It defines:

- `get($key, $default = null)`: Our plain get by key, returning `$default` on cache misses.
- `getOrSet($key, $value)`: Gets cached values by key, storing and returning `$value` on cache misses.
- `getOrLazySet($key, $callback)`: Same as `getOrSet` but with lazy evaluation of `$callback` on cache misses.
- `set($key, $value)`: No secrets, a vanilla set by key.
- `remove($key)`: Remove items only when not missed the cache.
- `getItem($key)`: Return the `ItemInterface` created by the underlying `StorageInterface`.

### Example

    // Storage is any StorageInterface implementation
    $cache = new Cache($storage);

    $result = $cache->get('key_1'); // null on cache misses
    $result = $cache->get('key_2', 'default'); // 'default' on cache misses
    $result = $cache->getOrSet('key_3', 'value'); // 'value' stored on cache misses
    $result = $cache->getOrLazySet('key_4', $callback); // $callback called only on cache misses

Strategy
--------
Implement the `StrategyInterface` to automate generation of concrete keys from any user-domain ones. This allows for automatic cache invalidation.

If injected into `Cache`, keys go first through this object before calling `setItem($key)`.

Implementations:

- `FilesystemStrategy`: Treats keys as path filenames. Returns a key with last modified time to invalidate cache entries on file changes.

### Example

    $path = __DIR__ . '/to-do/';
    $strategy = new FilesystemStrategy();
    // Storage is any StorageInterface implementation
    $cache = new Cache($storage, $strategy);
    // Callback only called the first time and every time the $path content changes
    $cache->getOrLazySet($path, $callback);
