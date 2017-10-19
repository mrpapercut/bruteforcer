# BruteForcer

## Available languages
- Javascript/NodeJS
- PHP
- Python2.7

## Usage
See each file for individual usage.

### (Node)JS
```js
const bf = new Bruteforcer();
console.log(bf.match('hello'));
```

With hashing function
```js
const bf = new Bruteforcer();
hasher = str => {
  arr = str.split('');
  out = 1;
  arr.forEach(c => {
    out *= c.charCodeAt(0);
  });
  return out;
};
console.log(bf.match(13599570816, hasher));
```

### PHP
```php
$bf = new BruteForcer();
echo $bf->match('hello');
```

With hashing function
```php
$bf = new BruteForcer();

$hasher = function($str) {
  $arr = str_split($str);
  $out = 1;
  foreach($arr as $char) {
    $out *= ord($char);
  }
  return $out;
};

echo $bf->match(13599570816, $hasher);
```

### Python
```
bf = BruteForcer()
print bf.match('hello')
```

With hashing function
```
bf = BruteForcer()

def hasher(str):
    arr = list(str)
    out = 1
    for i in xrange(0, len(arr)):
        out *= ord(arr[i])

    return out

print bf.match(13599570816, hasher)
```
