var BruteForcer = require('../BruteForcer');

var bf = new BruteForcer();

var d1 = +new Date;

if (bf.match('hello')) {
    var diff = +new Date - d1;
    console.log('Successfully matched \'hello\' in', bf.roundcount, 'rounds (' + diff + 'ms)');
}