import types

'''
BF Python

Usage:
bf = BruteForcer()
print bf.match('hello')

def hasher(str):
    arr = list(str)
    out = 1
    for i in xrange(0, len(arr)):
        out *= ord(arr[i])

    return out

print bf.match(13599570816, hasher)
'''

class BruteForcer:
    def __init__(self, minlength = 1, maxlength = 8, alphabet = 'abcdefghijklmnopqrstuvwxyz0123456789', initializeArr = None):
        self.roundcount   = 0
        self.minlength    = minlength
        self.maxlength    = maxlength
        self.alphabet     = alphabet
        self.alphaArray   = list(self.alphabet)
        self.workingArray = []

        if (minlength > maxlength):
            raise ValueError('minlength is greater than maxlength')

        # Initialize working array
        if initializeArr != None:
            self.workingArray = initializeArr;

            if len(initializeArr) < self.minlength:
                i = len(initializeArr)

                while i < self.minlength:
                    self.workingArray.append(self.alphaArray[0])
                    i += 1
            else:
                self.minlength = len(initializeArr);

        else:
            for i in xrange(0, self.minlength):
                self.workingArray.append(self.alphaArray[0]);


    # Callback is for the generated string.
    # For example if you need to hash the result for matching,
    # callback would be the hashing function
    def match(self, matchString = '', callback = None):
        if (callback != None and isinstance(callback, types.FunctionType) == False):
            raise ValueError('callback is not a function')

        if (callback == None and len(matchString) > self.maxlength):
            raise ValueError('String to match is longer than maxlength, it will never match')

        # Setting checker function
        if (callback != None and isinstance(callback, types.FunctionType)):
            def checkMatch(str):
                return (callback(str) == matchString)
        else:
            def checkMatch(str):
                return str == matchString

        # Processing loop
        while (len(self.workingArray) <= self.maxlength):
            workStr = ''.join(self.workingArray)

            if (checkMatch(workStr)):
                return workStr

            self.workingIndex = len(self.workingArray) - 1
            self.updateWorkingArray()

        return false

    def updateWorkingArray(self):
        # Increment rounds counter
        self.roundcount += 1

        # At start, self.workingIndex is the last entry of workingArray

        # Check index of self.workingArray
          # - if entry is equal to last char of alphabet, reset to first character, and
            # - if there is a previous entry, decrement the workingIndex and recurse
            # - else if length workingArray < this.maxlength, prepend alphabet[0] to workArray
            # - else if length workingArray === this.maxlength, and all characters at max, end
          # - else up the current character

        if (self.alphaArray.index(self.workingArray[self.workingIndex]) == len(self.alphaArray) - 1):
            self.workingArray[self.workingIndex] = self.alphaArray[0];

            if (self.workingIndex > 0):
                self.workingIndex -= 1
                self.updateWorkingArray()
            elif (len(self.workingArray) < self.maxlength):
                self.workingArray = [self.alphaArray[0]] + self.workingArray
            else:
                sys.exit(['No matches found'])
        else:
            self.workingArray[self.workingIndex] = self.alphaArray[self.alphaArray.index(self.workingArray[self.workingIndex]) + 1]
