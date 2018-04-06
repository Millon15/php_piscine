#!/usr/bin/python

from helper import *

# for expanding the ~ in filenames; checking if a file exists
# expanduser, isfile, isdir, chdir
import os

day_location = "../d07/"
resources = "./resources_d07/"
tester_dir = os.getcwd()

# START OF TESTS  START OF TESTS  START OF TESTS  START OF TESTS

# files
exitcode, stdout, stderr = run_command('ls -1R ' + day_location)
to_filter = stdout.split("\n")
to_filter = [line for line in to_filter if day_location not in line]
filtered = [line for line in to_filter if "ex0" not in line]
after_grep = "\n".join(filtered)
answer = """
Tyrion.class.php

Greyjoy.class.php

Targaryen.class.php

House.class.php

Jaime.class.php
Lannister.class.php
Tyrion.class.php

IFighter.class.php
NightsWatch.class.php

Fighter.class.php
UnholyFactory.class.php
"""
test_boolean((after_grep == answer[:len(after_grep)]), "correct files");


# ex00
print("Tests for ex00")
exercise_dir = day_location + "ex00/"
run_command("cp " + resources + "ex00/test.php " + exercise_dir)
run_command("cp " + resources + "ex00/teo_test.php " + exercise_dir)
os.chdir(exercise_dir)

test_command("php -f test.php", """A Lannister is born !
My name is Tyrion
Short
Hear me roar!
""")

test_command("php -f teo_test.php", """A Lannister is born ! Woah
My name is Tyrion
Short
I like to roar!
""")

run_command("rm test.php")
run_command("rm teo_test.php")
os.chdir(tester_dir)

# ex01
print("\nTests for ex01")
exercise_dir = day_location + "ex01/"
run_command("cp " + resources + "ex01/test1.php " + exercise_dir)
run_command("cp " + resources + "ex01/test2.php " + exercise_dir)
run_command("cp " + resources + "ex01/Euron.class.php " + exercise_dir)
os.chdir(exercise_dir)

test_command("php -f test1.php", "We do not sow\n")

exitcode, stdout, stderr = run_command("php -f test2.php")
test_boolean(exitcode != 0, "fatal error was fatal as expected")

run_command("rm test1.php")
run_command("rm test2.php")
run_command("rm Euron.class.php")
os.chdir(tester_dir)

# ex02
print("\nTests for ex02")
exercise_dir = day_location + "ex02/"
run_command("cp " + resources + "ex02/test.php " + exercise_dir)
os.chdir(exercise_dir)

test_command("php -f test.php", """Viserys burns alive
Daenerys emerges naked but unharmed
""")

run_command("rm test.php")
os.chdir(tester_dir)

# ex03
print("\nTests for ex03")
exercise_dir = day_location + "ex03/"
run_command("cp " + resources + "ex03/test1.php " + exercise_dir)
run_command("cp " + resources + "ex03/test2.php " + exercise_dir)
os.chdir(exercise_dir)

test_command("php -f test1.php"
             , """House Stark of Winterfell : "Winter is coming"
House Martell of Sunspear : "Unbowed, Unbent, Unbroken"
""")

exitcode, stdout, stderr = run_command("php -f test2.php")
test_boolean(exitcode != 0, "fatal error was fatal as expected")

run_command("rm test1.php")
run_command("rm test2.php")
os.chdir(tester_dir)

# ex04
print("\nTests for ex04")
exercise_dir = day_location + "ex04/"
run_command("cp " + resources + "ex04/test.php " + exercise_dir)
os.chdir(exercise_dir)

test_command("php -f test.php"
             , """Not even if I'm drunk !
Let's do this.
With pleasure, but only in a tower in Winterfell, then.
Not even if I'm drunk !
Let's do this.
Not even if I'm drunk !
""")

run_command("rm test.php")
os.chdir(tester_dir)

# ex05
print("\nTests for ex05")
exercise_dir = day_location + "ex05/"
run_command("cp " + resources + "ex05/test1.php " + exercise_dir)
run_command("cp " + resources + "ex05/test2.php " + exercise_dir)
os.chdir(exercise_dir)

test_command("php -f test1.php"
             , """* looses his wolf on the enemy, and charges with courage *
* flees, finds a girl, grows a spine, and defends her to the bitter end *
""")

exitcode, stdout, stderr = run_command("php -f test2.php")
test_boolean(exitcode != 0, "fatal error was fatal as expected")

run_command("rm test1.php")
run_command("rm test2.php")
os.chdir(tester_dir)

# ex06
print("\nTests for ex06")
exercise_dir = day_location + "ex06/"
run_command("cp " + resources + "ex06/test1.php " + exercise_dir)
run_command("cp " + resources + "ex06/test2.php " + exercise_dir)
os.chdir(exercise_dir)

test_command("php -f test1.php", """(Factory absorbed a fighter of type foot soldier)
(Factory already absorbed a fighter of type foot soldier)
(Factory absorbed a fighter of type archer)
(Factory absorbed a fighter of type assassin)
(Factory can't absorb this, it's not a fighter)
(Factory fabricates a fighter of type foot soldier)
(Factory hasn't absorbed any fighter of type llama)
(Factory fabricates a fighter of type foot soldier)
(Factory fabricates a fighter of type archer)
(Factory fabricates a fighter of type foot soldier)
(Factory fabricates a fighter of type assassin)
(Factory fabricates a fighter of type foot soldier)
(Factory fabricates a fighter of type archer)
* draws his sword and runs towards the Hound *
* draws his sword and runs towards Tyrion *
* draws his sword and runs towards Podrick *
* draws his sword and runs towards the Hound *
* draws his sword and runs towards Tyrion *
* draws his sword and runs towards Podrick *
* shoots arrows at the Hound *
* shoots arrows at Tyrion *
* shoots arrows at Podrick *
* draws his sword and runs towards the Hound *
* draws his sword and runs towards Tyrion *
* draws his sword and runs towards Podrick *
* creeps behind the Hound and stabs at it *
* creeps behind Tyrion and stabs at it *
* creeps behind Podrick and stabs at it *
* draws his sword and runs towards the Hound *
* draws his sword and runs towards Tyrion *
* draws his sword and runs towards Podrick *
* shoots arrows at the Hound *
* shoots arrows at Tyrion *
* shoots arrows at Podrick *
""")

exitcode, stdout, stderr = run_command("php -f test2.php")
test_boolean(exitcode != 0, "fatal error was fatal as expected")

run_command("rm test1.php")
run_command("rm test2.php")
os.chdir(tester_dir)

# END OF TESTS  END OF TESTS  END OF TESTS  END OF TESTS  END OF TESTS

print_final_results()

