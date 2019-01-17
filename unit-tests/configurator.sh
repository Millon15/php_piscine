#/bin/zsh

if [[ ! "$1" ]]; then
    echo "Usage: ./configurator.sh <Path_to_your_php_piscine_folder>"
    exit 1
fi

PWD=$(pwd)
PP=$(cd $1; pwd)

for i in {1..7}; do
    k='py'
    if (( i == 5 )); then continue; fi
    if (( i == 6 )); then k='sh'; fi
    sed -i '' -e "s|day_location = .*|day_location = '$PP/d0$i/'|" test_d0${i}.$k
    sed -i '' -e "s|helpers = .*|helpers = '$PWD/helpers_d0$i/'|" test_d0${i}.$k
done

printf "Paths successfully updated to:\n"
echo "Piscine path: $PP"
echo "Helpers path: $PWD"
