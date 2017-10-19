import sys, os, time
sys.path.append(os.path.join(os.path.dirname(__file__), '..'))
from BruteForcer import BruteForcer

bf = BruteForcer()

d1 = int(round(time.time() * 1000))

def hasher(str):
    arr = list(str)
    out = 1
    for i in xrange(0, len(arr)):
        out += out * ord(arr[i])

    return out

if (bf.match(14251497120, hasher)):
    diff = str(int(round(time.time() * 1000)) - d1)
    print "Successfully matched 'hello' with hashing function in " + str(bf.roundcount) + " rounds (" + diff + "ms)"