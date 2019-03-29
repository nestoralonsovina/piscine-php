#!/bin/bash
set -x

curl -d login=user1 -d passwd=pass1 -d submit=OK  $URL/create.php
curl -d login=user2 -d passwd=pass2 -d submit=OK  $URL/create.php
curl -c user1.txt -d login=user1 -d passwd=pass1  $URL/login.php
curl -b user1.txt -d submit=OK -d msg=Bonjours  $URL/speak.php
curl -b user1.txt -c user1.txt  $URL/logout.php
curl -b user1.txt -d submit=OK -d msg=Bonjours  $URL/speak.php
curl -c user2.txt -d login=user2 -d passwd=pass2  $URL/login.php
curl -b user2.txt -d submit=OK -d msg=Hello  $URL/speak.php
curl -b user2.txt  $URL/chat.php
