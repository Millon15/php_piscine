#!/bin/zsh

#### ▼▼▼▼ Please insert global path to your day and resources folders below ▼▼▼▼ ####
WORK_D="$HOME/.Trash/d06/"
# WORK_D="$HOME/projects/php_piscine/d06/"
RES_D="$HOME/projects/php_piscine/resources/d06/"


# To use Single_checker© you need to be in the folder of the direct exersize
# For example in ex01 folder directly!
# How you can see Single_checker© will be launched if and only if you pass first argument to the program
##### ▼▼▼▼▼▼▼▼▼▼▼ Single_checker© below ▼▼▼▼▼▼▼▼▼▼▼ ####
if [[ $1 ]]; then
	TMP_EXC="$WORK_D/main_0${1}_$RANDOM.php"

	cp "$RES_D/main_0${1}.php" $TMP_EXC
	cat "$RES_D/main_0${1}.out" | tr '\n' '\r' | sed -e "s/<-.*->//g" | tr '\r' '\n' > main.out
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
	exit 1;
fi


# To use Mass_tester© you need to be in d06 folder directly!
# It means, that if you do 'ls', you get something like this:
# ex00 ex01 ex02 ex03 ex04
# How you can see Mass_tester© will be launched if and only if you don't pass first argument to the program
##### ▼▼▼▼▼▼▼▼▼▼▼ Mass_tester© below ▼▼▼▼▼▼▼▼▼▼▼ ####
for i in {0..4}; do
	TMP_EXC="$WORK_D/main_0${i}_$RANDOM.php"

	cd ex0$i
	cp "$RES_D/main_0${i}.php" $TMP_EXC
	cat "$RES_D/main_0${i}.out" | tr '\n' '\r' | sed -e "s/<-.*->//g" | tr '\r' '\n' > main.out
	php $TMP_EXC | tr '\n' '\r' | sed -e "s/<-.*->//g" | tr '\r' '\n' > my.out
	if [[ $(diff main.out my.out) ]]; then
		echo "FAILED: main_0${i}.php"
		echo -n "expect: |"; cat main.out
		echo '|';
		echo -n "output: |"; cat my.out
		echo '|'
	else
		echo "passed: main_0${i}.php"
	fi
	rm -f $TMP_EXC main.out my.out
	cd ..
done
