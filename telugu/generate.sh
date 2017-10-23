#!/bin/sh

language="telugu"
host="localhost"
db="saptagiri_"$language
usr="root"
pwd="mysql"

echo "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -u$usr -p$pwd

perl $language"/insert_author.pl" $host $db $usr $pwd $language
perl $language"/insert_feat.pl" $host $db $usr $pwd $language
perl $language"/insert_articles.pl" $host $db $usr $pwd $language
perl $language"/ocr.pl" $host $db $usr $pwd $language
