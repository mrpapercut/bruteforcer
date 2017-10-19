import sys, os, time
sys.path.append(os.path.join(os.path.dirname(__file__), '..'))
from BruteForcer import BruteForcer

bf = BruteForcer()

d1 = int(round(time.time() * 1000))

if (bf.match('hello')):
    diff = str(int(round(time.time() * 1000)) - d1)
    print "Successfully matched 'hello' in " + str(bf.roundcount) + " rounds (" + diff + "ms)"
