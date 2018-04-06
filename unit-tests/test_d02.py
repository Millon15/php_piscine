#!/usr/bin/python

from helper import *

day_location = "/Users/vbrazas/vbrazas/"

# START OF TESTS  START OF TESTS  START OF TESTS  START OF TESTS

# ex00
test_command(day_location + '/ex00/another_world.php', "")
test_command(day_location + '/ex00/another_world.php ' \
     + '"Cette phrase    contient des     espaces et          des tabulations"' \
     , "Cette phrase contient des espaces et des tabulations\n")
test_command(day_location + '/ex00/another_world.php " Ce param est traite " "mais pas celui la"' \
, "Ce param est traite\n")
test_command(day_location + '/ex00/another_world.php "\tCe\tparam \test\t traite\t"', "Ce param est traite\n")
test_command(day_location + '/ex00/another_world.php " Ce\tparam \test\t traite "', "Ce param est traite\n")
print("")

test_command(day_location + '/ex01/one_more_time.php', "");
test_command(day_location + '/ex01/one_more_time.php "Mercreday 1stJuily 99"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mardi 12 Novembre 2013 12:02:21"' , "1384254141\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:12:54"', "1360138374\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:12:53"', "1360138373\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:12:50"', "1360138370\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 6 Fevrier 2013 09:12:50"', "1360138370\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 13 09:12:50"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 9:12:50"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:0:50"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:12:5"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 0:0:0"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Wednesday 6 Fevrier 2013 09:12:50"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 6 February 2013 09:12:50"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Wednesday 6 February 2013 09:12:50"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 012:12:53"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:012:53"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 2013 09:12:012"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 02013 09:12:53"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 999 09:12:53"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mercredi 06 Fevrier 99 09:12:53"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mardi 12 Novembre 2013 12:02:21"', "1384254141\n");
test_command(day_location + '/ex01/one_more_time.php "Tuesday 12 Novembre 2013 12:02:21"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Wednesday 13 Novembre 2013 12:02:21"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Mardi 12 November 2013 12:02:21"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "samedi 2 novembre 2013 12:02:21"', "1383390141\n");
test_command(day_location + '/ex01/one_more_time.php "jeudi 9 April 2015 12:02:21"', "Wrong Format\n");
test_command(day_location + '/ex01/one_more_time.php "Jeudi 9 Avril 2015 12:02:21"', "1428573741\n");
test_command(day_location + '/ex01/one_more_time.php "Samedi 11 avril 2015 12:02:21"', "1428746541\n");
test_command(day_location + '/ex01/one_more_time.php "samedi 16 novembre 2013 12:02:721"', "Wrong Format\n");
print("")

test_command(day_location + "/ex02/magnifying_glass.php resources_d02/page.html", """<html><head><title>Nice page</title></head>
<body>Hello World <a href=http://cyan.com title="UN LIEN">CECI EST UN LIEN</a>
<br /><a href=http://www.riven.com> ET CA AUSSI <img src=wrong.image title="ET ENCORE CA"></a>
</body></html>
""")
print("")

# END OF TESTS  END OF TESTS  END OF TESTS  END OF TESTS  END OF TESTS

print_final_results();
