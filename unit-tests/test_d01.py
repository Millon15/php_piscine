#!/usr/bin/python

from helper import *

day_location = '/Users/vbrazas/projects/archive/php_piscine/d01/'
helpers = '/Users/vbrazas/projects/archive/php_piscine/unit-tests/helpers_d01/'

# START OF TESTS  START OF TESTS  START OF TESTS  START OF TESTS

# ex00
test_command('php ' + day_location + "ex00/hw.php", "Hello World\n")
print("")

# ex01
# test_command('php ' + helpers + "helper_ex01.zsh '" + day_location + "ex01/mlx.php'", "")
test_command('php ' + day_location + "ex01/mlx.php", "X" * 1000 + "\n")
print("")

# ex02 at bototm of file

# ex03
test_command('php ' + helpers + 'helper_ex03.php ' + day_location \
+ ' "Hello    World AAA"' \
+ ' "    b        d  w   r "' \
+ ' " "' \
+ ' ""' \
+ ' "a"' \
+ ' " a"' \
+ ' "a "' \
, """Array
(
    [0] => AAA
    [1] => Hello
    [2] => World
)
Array
(
    [0] => b
    [1] => d
    [2] => r
    [3] => w
)
Array
(
)
Array
(
)
Array
(
    [0] => a
)
Array
(
    [0] => a
)
Array
(
    [0] => a
)
""")
print("")

# ex04
test_command('php ' + day_location + "ex04/aff_param.php", "")
test_command('php ' + day_location + "ex04/aff_param.php toto ahah foo bar quax", """toto
ahah
foo
bar
quax
""")
test_command('php ' + day_location + 'ex04/aff_param.php ""', """
""")
test_command('php ' + day_location + 'ex04/aff_param.php "a"', """a
""")
print("")

# ex05
test_command('php ' + day_location + 'ex05/epur_str.php', "")
test_command('php ' + day_location + 'ex05/epur_str.php "Salut, comment ca va ?"', "Salut, comment ca va ?\n")
test_command('php ' + day_location + 'ex05/epur_str.php "     Hello World     "', "Hello World\n")
print("")

# ex06
test_command('php ' + day_location + 'ex06/ssap.php', "")
test_command('php ' + day_location + 'ex06/ssap.php foo bar', """bar
foo
""")
test_command('php ' + day_location + 'ex06/ssap.php foo bar "yo man" "A moi compte, deux mots" Xibul', """A
Xibul
bar
compte,
deux
foo
man
moi
mots
yo
""")
print("")

# ex07
test_command('php ' + day_location + 'ex07/rostring.php', "")
test_command('php ' + day_location + 'ex07/rostring.php sdfkjsdkl sdkjfskljdf', "sdfkjsdkl\n")
test_command('php ' + day_location + 'ex07/rostring.php "hello world  aaa" fslkdjf', "world aaa hello\n")
test_command('php ' + day_location + 'ex07/rostring.php "a b" fslkdjf', "b a\n")
test_command('php ' + day_location + 'ex07/rostring.php "a"', "a\n")
test_command('php ' + day_location + 'ex07/rostring.php "c b a"', "b a c\n")
test_command('php ' + day_location + 'ex07/rostring.php "a b c d e f g h i j k l"', "b c d e f g h i j k l a\n")
print("")

# ex08
test_command('php ' + helpers + 'helper_ex08.php ' + day_location + ' ""', "sorted")
test_command('php ' + helpers + 'helper_ex08.php ' + day_location + ' "" ""', "sorted")
test_command('php ' + helpers + 'helper_ex08.php ' + day_location + ' "a b"', "sorted")
test_command('php ' + helpers + 'helper_ex08.php ' + day_location + ' "a"', "sorted")
test_command('php ' + helpers + 'helper_ex08.php ' + day_location + ' "c b"', "sorted")
test_command('php ' + helpers + 'helper_ex08.php ' + day_location + ' "a b 1"', "unsorted")
test_command('php ' + helpers + 'helper_ex08.php ' + day_location + ' "a b"', "sorted")
test_command('php ' + helpers + 'helper_ex08.php ' + day_location + ' "a b c d e f g h i j j"', "sorted")
test_command('php ' + helpers + 'helper_ex08.php ' + day_location + ' "a b c d e f g h i j j j j j"', "sorted")
test_command('php ' + helpers + 'helper_ex08.php ' + day_location + ' "a b c d e f g h i j i"', "unsorted")
test_command('php ' + helpers + 'helper_ex08.php ' + day_location + ' "b a c d e f"', "unsorted")
print("")

test_command('php ' + day_location + 'ex09/ssap2.php', "")
test_command('php ' + day_location + 'ex09/ssap2.php toto tutu 4234 "_hop XXX" "##" "1948372 AhAhAh"'
, """AhAhAh
toto
tutu
XXX
1948372
4234
##
_hop
""")
test_command('php ' + day_location + 'ex09/ssap2.php abcd# abcd1 abcdA abcda'
, """abcdA
abcda
abcd1
abcd#
""")
test_command('php ' + day_location + 'ex09/ssap2.php aaa aaaa', """aaa
aaaa
""")
test_command('php ' + day_location + 'ex09/ssap2.php "aaa aaaa"', """aaa
aaaa
""")
test_command('php ' + day_location + 'ex09/ssap2.php "hello               "'
, """hello
""")
test_command('php ' + day_location + 'ex09/ssap2.php "aaaa aaa"'
, """aaa
aaaa
""")
test_command('php ' + day_location + 'ex09/ssap2.php aaaa aaa'
, """aaa
aaaa
""")
# TODO: someone some tests here to test the ord thingy
print("")

test_command('php ' + day_location + 'ex10/do_op.php', "Incorrect Parameters\n")
test_command('php ' + day_location + 'ex10/do_op.php "" "" "" "fourth"', "Incorrect Parameters\n")
test_command('php ' + day_location + 'ex10/do_op.php "first" "second"', "Incorrect Parameters\n")
test_command('php ' + day_location + 'ex10/do_op.php 1 + 3', "4\n")
test_command('php ' + day_location + 'ex10/do_op.php 1 - 3', "-2\n")
test_command('php ' + day_location + 'ex10/do_op.php 5 * 3', "15\n")
test_command('php ' + day_location + 'ex10/do_op.php 99 * 189274987', "18738223713\n")
test_command('php ' + day_location + 'ex10/do_op.php   " 1" " *" " 3"', "3\n")
test_command('php ' + day_location + 'ex10/do_op.php 42 "% " 3', "0\n")
test_command('php ' + day_location + 'ex10/do_op.php "   1 " + 3', "4\n")
test_command('php ' + day_location + 'ex10/do_op.php "    5" "   *   " 3', "15\n")
test_command('php ' + day_location + 'ex10/do_op.php "\t5" "*\t" "3\t"', "15\n")
test_command('php ' + day_location + 'ex10/do_op.php "5" "*" "\t3"', "15\n")
test_command('php ' + day_location + 'ex10/do_op.php "5" "\t*" "3"', "15\n")
test_command('php ' + day_location + 'ex10/do_op.php "\t5" "*" "3"', "15\n")
test_command('php ' + day_location + 'ex10/do_op.php "\t 5 \t" "  \t  *\t " "\t3 "', "15\n")
test_command('php ' + day_location + 'ex10/do_op.php "-3 \t  " " \t * " " -3"', "9\n")
test_command('php ' + day_location + 'ex10/do_op.php "  50" "% " " 20"', "10\n")
test_command('php ' + day_location + 'ex10/do_op.php "-3  " "  *" "  -3"', "9\n")
test_command('php ' + day_location + 'ex10/do_op.php "-3" "/ " " 2"', "-1.5\n")
test_command('php ' + day_location + 'ex10/do_op.php "-3 " "+ " " 5"', "2\n")
print("")

test_command('php ' + day_location + "ex11/do_op_2.php", "Incorrect Parameters\n")
test_command('php ' + day_location + "ex11/do_op_2.php first second", "Incorrect Parameters\n")
test_command('php ' + day_location + "ex11/do_op_2.php toto", "Syntax Error\n")
test_command('php ' + day_location + 'ex11/do_op_2.php "42 * 2" ', "84\n")
test_command('php ' + day_location + 'ex11/do_op_2.php "42 / 2" ', "21\n")
test_command('php ' + day_location + 'ex11/do_op_2.php "42 % 2" ', "0\n")
test_command('php ' + day_location + 'ex11/do_op_2.php "42 % 3" ', "0\n")
test_command('php ' + day_location + 'ex11/do_op_2.php "42 - 2" ', "40\n")
test_command('php ' + day_location + 'ex11/do_op_2.php "six6*7sept" ', "Syntax Error\n")
test_command('php ' + day_location + 'ex11/do_op_2.php "ls -lR /" ', "Syntax Error\n")
test_command('php ' + day_location + 'ex11/do_op_2.php "10000 * 20000000" ', "200000000000\n")
test_command('php ' + day_location + 'ex11/do_op_2.php "-3 \t    \t *   -3" ', "9\n")
test_command('php ' + day_location + 'ex11/do_op_2.php "50 % 20" ', "10\n")
test_command('php ' + day_location + 'ex11/do_op_2.php "-3 * -3" ', "9\n")
test_command('php ' + day_location + 'ex11/do_op_2.php "-3 / 2" ', "-1.5\n")
test_command('php ' + day_location + 'ex11/do_op_2.php "-3 + 5" ', "2\n")
print("")

test_command('php ' + day_location + 'ex12/search_it!.php', "")
test_command('php ' + day_location + 'ex12/search_it!.php toto', "")
test_command('php ' + day_location + 'ex12/search_it!.php toto "key1:val1" "key2:val2" "toto:42"', "42\n")
test_command('php ' + day_location + 'ex12/search_it!.php  toto "toto:val1" "key2:val2" "toto:42"', "42\n")
test_command('php ' + day_location + 'ex12/search_it!.php "toto" "key1:val1" "key2:val2" "0:hop"', "")
test_command('php ' + day_location + 'ex12/search_it!.php  "0" "key1:val1" "key2:val2" "0:hop"', "hop\n")
print("")

#ex13
test_command('php ' + day_location + 'ex13/agent_stats.php < ' + '' + helpers + 'resources01/peer_notes_1.csv', "")
# test_command('php ' + day_location + 'ex13/agent_stats.php < ' + 'average' + helpers + 'resources01/peer_notes_1.csv', "9.8621262458472")
print("")

# END OF TESTS  END OF TESTS  END OF TESTS  END OF TESTS  END OF TESTS

# ex02
print("Note: ex02 must be checked manually: " + day_location + "ex02/oddeven.php")
print("""Input ideas:
  42
  0
  -0
  1
  2
  100000000000000000000000000000000000000000000
  -100
  <blank string>
  toto
  99cosmos
Text: 
  "Entrez un nombre: "
  "Le chiffre 42 est Pair"
  "Le chiffre 1 est Impair"
  "'99cosmos' n'est pas un chiffre"
Other:
  C-d to close should exit smoothly""")

# test_command('php ' + day_location + 'ex02/oddeven.php < ' + helpers + 'helper_ex02.txt',
# """Enter a number: The number 42 is even
# Enter a number: The number 0 is even
# Enter a number: The number -0 is even
# Enter a number: The number 1 is odd
# Enter a number: The number 2 is even
# Enter a number: The number 100000000000000000000000000000000000000000000 is even
# Enter a number: The number -100 is even
# Enter a number: '' is not a number
# Enter a number: 'toto' is not a number
# Enter a number: '99cosmos' is not a number
# Enter a number: '"Entrez un nombre: "' is not a number
# Enter a number: '"Le chiffre 42 est Pair"' is not a number
# Enter a number: '"Le chiffre 1 est Impair"' is not a number
# Enter a number: '"'99cosmos' n'est pas un chiffre"' is not a number
# Enter a number: ^D""")
# print("")

print_final_results()
