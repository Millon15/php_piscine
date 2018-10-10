#!/bin/zsh

WORK_D='/Users/vbrazas/projects/php_piscine/d06/'
RES_D='/Users/vbrazas/projects/php_piscine/resources/d06/'

TMP_EXC="$WORK_D/main_0$1_$RANDOM.php"

cp "$RES_D/main_0$1.php" $TMP_EXC
cat "$RES_D/main_0$1.out" | tr '\n' '\r' | sed -e "s/<-.*->//g" | tr '\r' '\n' > main.out
php $TMP_EXC | tr '\n' '\r' | sed -e "s/<-.*->//g" | tr '\r' '\n' > my.out
diff main.out my.out > diffs.out
rm -f $TMP_EXC
if [[ $(head diffs.out) ]]; then
	echo "You lose!"
	sleep 2
	less diffs.out
else
	rm -f main.out my.out diffs.out
fi
