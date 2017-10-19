/*
BF JS

Usage:
const bf = new Bruteforcer();
console.log(bf.match('hello'));

Example with hasher:
hasher = str => {
  arr = str.split('');
  out = 1;
  arr.forEach(c => {
    out *= c.charCodeAt(0);
  });
  return out;
};
console.log(bf.match(13599570816, hasher));
*/

class BruteForcer {
    constructor(minlength, maxlength, charset, initializeArray) {
        this.roundcount   = 0;
        this.minlength    = minlength || 1;
        this.maxlength    = maxlength || 8;
        this.charset      = charset   || 'abcdefghijklmnopqrstuvwxyz0123456789';
        this.alphaArray   = this.charset.split('');
        this.workingArray = [];

        if (this.minlength > this.maxlength) {
            throw Error('minlength is greater than maxlength');
        }

        // Initialize working array
        if (initializeArray && initializeArray instanceof Array) {
            this.workingArray = initializeArray;

            if (initializeArray.length < this.minlength) {
                // Pad with character alphaArray[0]
                for (var i = initializeArray.length; i < this.minlength; i++) {
                    this.workingArray.push(this.alphaArray[0]);
                }
            } else {
                this.minlength = initializeArray.length;
            }
        } else {
            for (var i = 0; i < this.minlength; i++) {
                this.workingArray.push(this.alphaArray[0]);
            }
        }
    }

    // Callback is for the generated string.
    // For example if you need to hash the result for matching,
    // $callback would be the hashing function
    match(matchString, callback) {
        if (callback && !(callback instanceof Function)) {
            throw Error('Callback is not a function');
        }

        if (!callback && matchString > this.maxlength) {
            throw Error('String to match is longer than maxlength, it will never match');
        }

        // Setting checker function
        let checkMatch = (callback && callback instanceof Function)
            ? str => callback(str) === matchString
            : str => str === matchString;

        // Processing loop
        while (this.workingArray.length <= this.maxlength) {
            var workStr = this.workingArray.join('');

            if (checkMatch(workStr)) {
                return workStr;
            }

            this.workingIndex = this.workingArray.length - 1;
            this.updateWorkingArray();
        }

        return false;
    }

    updateWorkingArray() {
        // Increment rounds counter
        this.roundcount++;

        /*
        At start, this.workingIndex is the last entry of workingArray

        Check index of this.workingArray
          - if entry is equal to last char of charset, reset to first character, and
            - if there is a previous entry, decrement the workingIndex and recurse
            - else if length workingArray < this.maxlength, prepend charset[0] to workArray
            - else if length workingArray === this.maxlength, and all characters at max, end
          - else up the current character
        */
        if (this.alphaArray.indexOf(this.workingArray[this.workingIndex]) === this.alphaArray.length - 1) {
            this.workingArray[this.workingIndex] = this.alphaArray[0];

            if (this.workingIndex > 0) {
                this.workingIndex--;
                this.updateWorkingArray();
            } else if (this.workingArray.length < this.maxlength) {
                this.workingArray.unshift(this.alphaArray[0]);
            } else {
                die('No matches found');
            }
        } else {
            this.workingArray[this.workingIndex] =
                this.alphaArray[this.alphaArray.indexOf(this.workingArray[this.workingIndex]) + 1];
        }
    }
}

module.exports = BruteForcer;
