#!/usr/bin/python

from helper import *

# for expanding the ~ in filenames; checking if a file exists
import os
from os.path import expanduser
from os.path import isfile
from os.path import isdir

day_location = "../d04/"

# START OF TESTS  START OF TESTS  START OF TESTS  START OF TESTS

if not isdir(expanduser("~/mamp/apps/j04")):
    print("Do you have mamp installed? The folder ~/mamp/apps/j04 doesn't exist.")
    print("mkdir ~/mamp/apps/j04")
    exit(1)

print("Copying git repo to the correct location...")
exitcode, out, err = run_command("rsync -rv --exclude=.git " + day_location + " " + expanduser("~/mamp/apps/j04/htdocs"))
if (len(err) > 0 and "identical" not in err):
    print("Failed to copy files!")
    print(err)
    exit(1)
run_command("mkdir " + expanduser("~/mamp/apps/j04/conf"))
run_command("cp " + day_location + "ex00/httpd-app.conf " + expanduser("~/mamp/apps/j04/conf"))
run_command("cp " + day_location + "ex00/httpd-vhosts.conf " + expanduser("~/mamp/apps/j04/conf"))
run_command("cp " + expanduser("~/mamp/apps/demo/conf/httpd-prefix.conf") + " " + expanduser("~/mamp/apps/j04/conf"))

print("")

print("Tests for ex00:")
print("NOTE: We could move the bitnami-apps-vhosts.conf file to the right place, but it's better to just check by hand...")
print("cat " + day_location + " ex00/bitnami-apps-vhosts.conf")
print("cat ~/mamp/apache2/conf/bitnami/bitnami-apps-vhosts.conf")

# ex01
print("\nTests for ex01:")
exitcode, out, err = run_command("curl -v -c cook.txt 'http://j04.local.42.fr:8080/ex01/index.php' | grep 'login'")
test_boolean('name="login"' in out, "login named correctly")
test_boolean(("value" not in out) or ('value=""' in out), "login set correctly")
exitcode, out, err = run_command("curl -v -c cook.txt 'http://j04.local.42.fr:8080/ex01/index.php' | grep 'passwd'")
test_boolean('name="passwd"' in out, "passwd named correctly")
test_boolean(("value" not in out) or ('value=""' in out), "passwd set correctly")
exitcode, out, err = run_command("curl -v -c cook.txt 'http://j04.local.42.fr:8080/ex01/index.php' | grep 'submit'")
test_boolean('name="submit"' in out, "submit named correctly")
test_boolean(("value" not in out) or ('value="OK"' in out), "submit set correctly")

exitcode, out, err = run_command("curl -v -b cook.txt 'http://j04.local.42.fr:8080/ex01/index.php?login=sb&passwd=beeone' | grep 'login'")
test_boolean('name="login"' in out, "login named correctly after no ok")
test_boolean(("value" not in out) or ('value=""' in out), "login set correctly after no ok")
exitcode, out, err = run_command("curl -v -b cook.txt 'http://j04.local.42.fr:8080/ex01/index.php?login=sb&passwd=beeone' | grep 'passwd'")
test_boolean('name="passwd"' in out, "passwd named correctly after no ok")
test_boolean(("value" not in out) or ('value=""' in out), "passwd set correctly after no ok")
exitcode, out, err = run_command("curl -v -b cook.txt 'http://j04.local.42.fr:8080/ex01/index.php?login=sb&passwd=beeone' | grep 'submit'")
test_boolean('name="submit"' in out, "submit named correctly after no ok")
test_boolean(("value" not in out) or ('value="OK"' in out), "submit set correctly after no ok")

exitcode, out, err = run_command("curl -v -b cook.txt 'http://j04.local.42.fr:8080/ex01/index.php?login=sb&passwd=beeone&submit=OK' | grep 'login'")
test_boolean('name="login"' in out, "login named correctly after ok")
test_boolean('value="sb"' in out, "login set correctly after ok")
exitcode, out, err = run_command("curl -v -b cook.txt 'http://j04.local.42.fr:8080/ex01/index.php?login=sb&passwd=beeone' | grep 'passwd'")
test_boolean('name="passwd"' in out, "passwd named correctly after ok")
test_boolean('value="beeone"' in out, "passwd set correctly after ok")
exitcode, out, err = run_command("curl -v -b cook.txt 'http://j04.local.42.fr:8080/ex01/index.php?login=sb&passwd=beeone' | grep 'submit'")
test_boolean('name="submit"' in out, "submit named correctly after ok")
test_boolean('value="OK"' in out, "submit set correctly after ok")

exitcode, out, err = run_command("curl -v -b cook.txt 'http://j04.local.42.fr:8080/ex01/index.php' | grep 'login'")
test_boolean('name="login"' in out, "login named correctly after not passing stuff in url")
test_boolean('value="sb"' in out, "login set correctly after not passing stuff in url")
exitcode, out, err = run_command("curl -v -b cook.txt 'http://j04.local.42.fr:8080/ex01/index.php' | grep 'passwd'")
test_boolean('name="passwd"' in out, "passwd named correctly after not passing stuff in url")
test_boolean('value="beeone"' in out, "passwd set correctly after not passing stuff in url")
exitcode, out, err = run_command("curl -v -b cook.txt 'http://j04.local.42.fr:8080/ex01/index.php' | grep 'submit'")
test_boolean('name="submit"' in out, "submit named correctly after not passing stuff in url")
test_boolean('value="OK"' in out, "submit set correctly after not passing stuff in url")

exitcode, out, err = run_command("curl -v 'http://j04.local.42.fr:8080/ex01/index.php' | grep 'login'")
test_boolean('name="login"' in out, "login named correctly after removing cookie file")
test_boolean(("value" not in out) or ('value=""' in out), "login set correctly after removing cookie file")
exitcode, out, err = run_command("curl -v -c cook.txt 'http://j04.local.42.fr:8080/ex01/index.php' | grep 'passwd'")
test_boolean('name="passwd"' in out, "passwd named correctly after removing cookie file")
test_boolean(("value" not in out) or ('value=""' in out), "passwd set correctly after removing cookie file")
exitcode, out, err = run_command("curl -v -c cook.txt 'http://j04.local.42.fr:8080/ex01/index.php' | grep 'submit'")
test_boolean('name="submit"' in out, "submit named correctly after removing cookie file")
test_boolean(("value" not in out) or ('value="OK"' in out), "submit set correctly after removing cookie file")

run_command("rm -rf cook.txt")

print("")

# ex02
print("Tests for ex02:")
run_command("rm " + expanduser("~/mamp/apps/j04/htdocs/private/passwd"))
test_command("curl -d login=toto1 -d passwd=titi1 -d submit=OK 'http://j04.local.42.fr:8080/ex02/create.php'", "OK\n", 0)
password_file = expanduser("~/mamp/apps/j04/htdocs/private/passwd")
test_boolean('a:1:{' == get_file_contents(password_file)[:5]
                  , "begin part of serialized file (" + password_file + ")")
test_command("curl -d login=toto1 -d passwd=titi1 -d submit=OK 'http://j04.local.42.fr:8080/ex02/create.php'", "ERROR\n", 0)
test_command("curl -d login=toto2 -d passwd= -d submit=OK 'http://j04.local.42.fr:8080/ex02/create.php'", "ERROR\n", 0)
test_command("curl -d login= -d passwd=hello -d submit=OK 'http://j04.local.42.fr:8080/ex02/create.php'", "ERROR\n", 0)
test_command("curl -d login=toto1 -d passwd=titi1 -d submit=OK 'http://j04.local.42.fr:8080/ex02/create.php'", "ERROR\n", 0)
test_command("curl -d login=toto1 -d passwd=titi1 -d submit=OKK 'http://j04.local.42.fr:8080/ex02/create.php'", "ERROR\n", 0)
test_command("curl -d login=login -d passwd=password 'http://j04.local.42.fr:8080/ex02/create.php'", "ERROR\n", 0)
exitcode, out, err = run_command("curl -v 'http://j04.local.42.fr:8080/ex02/index.html'")
test_boolean('method="POST"' in out or 'method="post"' in out, "correct method")
run_command("rm -rf " + expanduser("~/mamp/apps/j04/htdocs/private"))
print("")

# ex03
print("Tests for ex03:")
run_command("rm " + expanduser("~/mamp/apps/j04/htdocs/private/passwd"))
test_command("curl -d login=x -d passwd=21 -d submit=OK 'http://j04.local.42.fr:8080/ex02/create.php'", "OK\n", 0)
password_file = "~/mamp/apps/j04/htdocs/private/passwd"
test_boolean('a:1:{' == get_file_contents("~/mamp/apps/j04/htdocs/private/passwd")[:5]
                  , "begin part of serialized file (" + password_file + ")")
test_command("curl -d login=x -d oldpw=21 -d newpw=42 -d submit=OK 'http://j04.local.42.fr:8080/ex03/modif.php'", "OK\n", 0) # change to 42
test_command("curl -d login=x -d oldpw=42 -d newpw=hello -d submit=OK 'http://j04.local.42.fr:8080/ex03/modif.php'", "OK\n", 0) # change to hello
test_command("curl -d login=x -d oldpw=hello -d newpw=42 'http://j04.local.42.fr:8080/ex03/modif.php'", "ERROR\n", 0) # no submit=OK
test_command("curl -d login=x -d oldpw=hello -d newpw=42 -d submit=OK 'http://j04.local.42.fr:8080/ex03/modif.php'", "OK\n", 0) # change to 42

test_command("curl -d login=x -d oldpw=21 -d newpw=42 -d submit=OK 'http://j04.local.42.fr:8080/ex03/modif.php'", "ERROR\n", 0) # wrong password
test_command("curl -d login=x -d oldpw=42 -d newpw= -d submit=OK 'http://j04.local.42.fr:8080/ex03/modif.php'", "ERROR\n", 0) # blank new password

exitcode, out, err = run_command("curl -v 'http://j04.local.42.fr:8080/ex03/index.html'")
test_boolean('method="POST"' in out or 'method="post"' in out, "correct method")
run_command("rm -rf " + expanduser("~/mamp/apps/j04/htdocs/private"))
print("")

# ex04
print("Tests for ex04:")
run_command("rm " + expanduser("~/mamp/apps/j04/htdocs/private/passwd"))
test_command("curl -d login=toto -d passwd=titi -d submit=OK 'http://j04.local.42.fr:8080/ex02/create.php'", "OK\n", 0)
password_file = "~/mamp/apps/j04/htdocs/private/passwd"
test_boolean('a:1:{' == get_file_contents("~/mamp/apps/j04/htdocs/private/passwd")[:5]
                  , "begin part of serialized file (" + password_file + ")")
test_command("curl 'http://j04.local.42.fr:8080/ex04/login.php?login=toto&passwd=titi'", "OK\n", 0) # check login.php: correct

run_command("rm -rf ~/mamp/apps/j04/htdocs/private")
run_command("curl -d login=toto -d passwd=titi -d submit=OK 'http://j04.local.42.fr:8080/ex02/create.php'")
test_command("curl -c cook.txt 'http://j04.local.42.fr:8080/ex04/login.php?login=toto&passwd=titi'", "OK\n", 0)
test_command("curl -b cook.txt 'http://j04.local.42.fr:8080/ex04/whoami.php'", "toto\n", 0)
test_command("curl -b cook.txt 'http://j04.local.42.fr:8080/ex04/logout.php'", "", 0)
test_command("curl -b cook.txt 'http://j04.local.42.fr:8080/ex04/whoami.php'", "ERROR\n", 0)

# END OF TESTS  END OF TESTS  END OF TESTS  END OF TESTS  END OF TESTS

print_final_results();
