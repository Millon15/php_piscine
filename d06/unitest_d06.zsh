#!/bin/zsh

MAIN_D='/Users/vbrazas/projects/php_piscine/resources/d06/'

cat "$MAIN_D/main_0$1.out" | tr '\n' '\r' | sed -e "s/<-.*->//g" | tr '\r' '\n' > main.out
php "$MAIN_D/main_0$1.php" | tr '\n' '\r' | sed -e "s/<-.*->//g" | tr '\r' '\n' > my.out
diff main.out my.out > dfs
if [[ $(head dfs) ]]; then
	echo "You lose!"
	sleep 2
	less dfs
else
	rm -f main.out my.out dfs
fi
