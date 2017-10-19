#!/bin/bash

echo "Running tests for Bruteforcer..."

echo -e "\nNodeJS:"
node tests/simple-match.js
node tests/hashing-match.js

echo -e "\nPHP"
php tests/simple-match.php
php tests/hashing-match.php

echo -e "\nPython"
python tests/simple-match.py
python tests/hashing-match.py