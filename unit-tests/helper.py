# for capturing output from a command ("ls -lA")
import shlex
from subprocess import Popen, PIPE

# for expanding ~ in paths
from os.path import expanduser

def run_command(cmd):
    """
    Execute the external command and get its exitcode, stdout and stderr.
    """
    args = shlex.split(cmd)
    
    proc = Popen(args, stdout=PIPE, stderr=PIPE)
    out, err = proc.communicate()
    exitcode = proc.returncode
    return exitcode, out, err

# count of things that didn't go so well
failed_count = 0

def get_file_contents(filename):
    to_open = expanduser(filename)
    try:
        return open(to_open, 'r').read()
    except:
        print("Tried to open a file but failed: " + str(to_open))
        exit(1)

def test_command(command, expected, check_std_err = 1):
    global failed_count
    try:
        exitcode, out, err = run_command(command)
    except:
        print("""The program couldn't execute the command.
Here's the command for debugging purposes:
""")
        print(str(command))
        exit(1)
    if (expected == out):
        if (len(command) > 100):
            command = command[:100] + "...";
        print("passed: " + command)
    else:
       print("FAILED: " + str(command))
       print("expect: |" + str(expected) + "|")
       print("output: |" + str(out) + "|")
       failed_count += 1
    if (check_std_err and len(err) > 0):
        print("Standard error is not empty: |"+ str(err) + "|")

def test_boolean(boolean, string):
    global failed_count
    if (boolean):
        print("passed: " + str(string))
    else:
        print("FAILED: " + str(string))
        failed_count += 1;

def print_final_results():
    print("")
    if (failed_count > 0):
        print("FAILED COUNT: " + str(failed_count))
    else:
        print("Everything looks good from here!")
