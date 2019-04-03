# Hello cheatera!
### **FiRsT of aLL**

Introducing brand new way to run your `php-piscine` named `docker-compose`
To make this thing run you just need to have docker installed on your school mac.
You can install it from `managed software centere` or by running `./docker_init.sh` in your terminal, for terminal installation brew42 is mandatory(google it, if you don't know how to install brew42).

To up your local web server(with mysql and phpmyadmin onboard) fire following commands

```bash
docker-machine start default
eval $(docker-machine env default)
docker-compose up -d
```

Now your web `server` is running and available via address, that can be get by the command below:
```bash
echo web server - $(docker-machine ip default):8989
```

Correspondingly you can get access to the `phpmyadmin` on:
```bash
echo phpmyadmin - $(docker-machine ip default):8181
```

BTW, below you can find environment variables, that help you access to mysql database via `docker-compose exec mysql bash` or via `phpmyadmin`
It can help you with both Rushes and day05.
```bash
MYSQL_DATABASE=d05
MYSQL_USER=sql42
MYSQL_PASSWORD=sql42
MYSQL_ROOT_PASSWORD=sql42
```

If, with mysql, you will have troubles like this:
```
ERROR 1044 (42000): Access denied for user 'sql42'@'%' to database
```

Please enter your mysql session as root user, for user `root` password same as `sql42` user.
```
mysql -uroot -psql42
```

If you would appear to be stuck with the procedures subscribed above, please follow docker docs on internet!

### **Some of us use checkers time to time, some of us haven't used it before, but today everything will change! Introducing Checker for php_piscine!!!**

So you can ask me: `How can we use these gorgeous unit-tests?` I can easily answer: `You just need to...`

### 1. Open unit-test folder

### 2. Watch out for an appropriate test for you

For example you need to test day01 of your piscine: `test_d01.py` fits perfectly

### 3. Then you need to configure this test for your purposes

Go to `unit-tests` folder and run the `configurator.sh` script with one argument:

Usage:
```bash
./configurator.sh <Path_to_your_php_piscine_folder>
```

Example:
```bash
./configurator.sh /Users/vbrazas/projects/archive/php_piscine/
~OR~
./configurator.sh ../
```

Now you can easely use all tests!
