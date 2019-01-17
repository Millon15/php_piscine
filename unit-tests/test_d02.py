#!/usr/bin/python

from helper import *

day_location = '/Users/vbrazas/projects/archive/php_piscine/d02/'
helpers = '/Users/vbrazas/projects/archive/php_piscine/unit-tests/helpers_d02/'

# START OF TESTS  START OF TESTS  START OF TESTS  START OF TESTS

# ex00
test_command('php ' + day_location + '/ex00/another_world.php', "")
test_command('php ' + day_location + '/ex00/another_world.php ' \
     + '"Cette phrase    contient des     espaces et          des tabulations"' \
     , "Cette phrase contient des espaces et des tabulations\n")
test_command('php ' + day_location + '/ex00/another_world.php " Ce param est traite " "mais pas celui la"' \
, "Ce param est traite\n")
test_command('php ' + day_location + '/ex00/another_world.php "\tCe\tparam \test\t traite\t"', "Ce param est traite\n")
test_command('php ' + day_location + '/ex00/another_world.php " Ce\tparam \test\t traite "', "Ce param est traite\n")
print("")

# ex01
test_command('php ' + day_location + '/ex01/one_more_time.php', "")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercreday 1stJuily 99"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mardi 12 Novembre 2013 12:02:21"' , "1384254141\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:12:54"', "1360138374\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:12:53"', "1360138373\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:12:50"', "1360138370\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 Fevrier 2013 09:12:50"', "1360138370\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 13 09:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 9:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:0:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:12:5"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 0:0:0"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Wednesday 6 Fevrier 2013 09:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 February 2013 09:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Wednesday 6 February 2013 09:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 012:12:53"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:012:53"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:12:012"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 02013 09:12:53"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 999 09:12:53"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 99 09:12:53"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mardi 12 Novembre 2013 12:02:21"', "1384254141\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Tuesday 12 Novembre 2013 12:02:21"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Wednesday 13 Novembre 2013 12:02:21"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mardi 12 November 2013 12:02:21"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "samedi 2 novembre 2013 12:02:21"', "1383390141\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "jeudi 9 April 2015 12:02:21"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Jeudi 9 Avril 2015 12:02:21"', "1428573741\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Samedi 11 avril 2015 12:02:21"', "1428746541\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "samedi 16 novembre 2013 12:02:721"', "Wrong Format\n")

test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 Fevrier 2013 9:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 7 Fevrier 2013 09:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 Fevrier 2014 09:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 46 Fevrier 2013 09:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 Fevriers 2013 09:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredis 6 Fevrier 2013 09:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 Fevrier 2013 -09:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 Fevrier 2013 09:-12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 Fevrier 2013 09:12:-50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 Fevrier 2013 09:12:501"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 Fevrier 2013 09:001:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 Fevrier 2013 09:12:001"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 Fevrier 2013 001:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 Fevrier 02013 09:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi 6 Fevrier 20130 09:12:50"', "Wrong Format\n")
test_command('php ' + day_location + '/ex01/one_more_time.php "Mercredi -6 Fevrier 2013 09:12:50"', "Wrong Format\n")

print("")

# ex02
test_command('php ' + day_location + "/ex02/magnifying_glass.php " + helpers + "page.html",
"""<html><head><title>Nice page</title></head>
<body>Hello World <a href=http://cyan.com title="UN LIEN">CECI EST UN LIEN</a>
<br /><a href=http://www.riven.com> ET CA AUSSI <img src=wrong.image title="ET ENCORE CA"></a>
</body></html>
""")
print("")

# ex03
exitcode, out, err = run_command('who')
test_command('php ' + day_location + "/ex03/who.php", out)
print("")

# ex04
print("Note: ex04 must be checked manually: " + day_location + "ex04/photos.php")
print("""Input ideas:
valid inputs:
  ./photos.php "http://www.42.fr"
  ./photos.php "http://www.google.com"
  ./photos.php "http://www.facebook.com"
error managment:
  ./photos.php "http://en.wikipedia.org/wiki/OpenNet"
  ./photos.php "http://www.vk.com"
  ./photos.php "http://www.yandex.ru"

ex05 must be checked manually too!
""")

#ex06
test_command('php ' + day_location + "/ex06/srt.php " + helpers + "test.srt",
"""1
00:01:15,308 --> 00:01:16,717
Ceci

2
00:01:16,817 --> 00:01:19,650
est

3
00:01:19,750 --> 00:01:21,373
un

4
00:01:21,473 --> 00:01:23,614
test
""")
test_command('php ' + day_location + "/ex06/srt.php " + helpers + "test1.srt",
"""1
00:01:15,308 --> 00:01:16,717
This

2
00:01:16,817 --> 00:01:19,650
is

3
00:01:19,750 --> 00:01:21,373
a

4
00:01:21,473 --> 00:01:23,614
test
""")
test_command('php ' + day_location + "/ex06/srt.php " + helpers + "test2.srt",
"""1
00:01:15,308 --> 00:01:16,717
This

2
00:01:16,817 --> 00:01:19,650
is

3
00:01:19,750 --> 00:01:21,373
a

4
00:01:21,473 --> 00:01:23,614
test
""")

# END OF TESTS  END OF TESTS  END OF TESTS  END OF TESTS  END OF TESTS

print_final_results()
