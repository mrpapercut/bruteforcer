# BruteForcer

## Available languages
- Javascript/NodeJS
- PHP
- Python2.7

## Usage
new BruteForcer((int) minLength, (int) maxLength, (string) alphabet, (array) initializeArray)

* **minLength** is minimum length of bruteforce characters, default = 1
* **maxLength** is maximum length of bruteforce characters, default = 8
* **alphabet**  is a string of characters to use in bruteforcing, default = 'abcdefghijklmnopqrstuvwxyz0123456789'
* **initializeArray** is an array of characters to initialize the bruteforcer*, default is null

\* If you want to start bruteforcing with string 'zaaaa' with minlength 5, use initializeArray = ['z']

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
```python
bf = BruteForcer()
print bf.match('hello')
```

With hashing function
```python
bf = BruteForcer()

def hasher(str):
    arr = list(str)
    out = 1
    for i in xrange(0, len(arr)):
        out *= ord(arr[i])

    return out

print bf.match(13599570816, hasher)
```
