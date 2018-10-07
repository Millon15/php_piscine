# Hello cheatera!
### **Some of us use checkers time to time, some of us haven't used it before, but today everything will change! Introducing pyChecker for php_piscine!!!**

So you can ask me: `How can we use these gorgeous unit-tests?` I can easily answer: `You just need to...`

### 1. Open unit-test folder
### 2. Watch out for an appropriate test for you
For example you need to test day01 of your piscine: `test_d01.py` fits perfectly
### 3. Then you need to configure this test for your purposes
For example your `d01` folder lies this way:

	├── d01
	└── unit-tests
So you need to edit head of `test_d01.py` the next way:
```python
#!/usr/bin/python

from helper import *

day_location = "../d01/"
helpers = "helpers_d01/"

# START OF TESTS  START OF TESTS  START OF TESTS  START OF TESTS
```
### Congrats! Now unit-test is finally configured and you can easily run it:
```bash
./test_d01.py
```