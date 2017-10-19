var BruteForcer = require('../BruteForcer');

var bf = new BruteForcer();

var d1 = +new Date;

hasher = str => {
    arr = str.split('');
    out = 1;
    arr.forEach(c => {
        out += out * c.charCodeAt(0)
    });

    return out;
};

if (bf.match(14251497120, hasher)) {
    var diff = +new Date - d1;
    console.log('Successfully matched \'hello\' with hashing function in', bf.roundcount, 'rounds (' + diff + 'ms)');
}