if [[ $(wc -c < $1) -gt 100 ]]; then
	echo "$1 has more than 100 characters! Fix it!";
fi
