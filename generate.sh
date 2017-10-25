#!/bin/sh
host="localhost"
usr="root"
pwd='mysql'


# Telugu

language="telugu"
db="saptagiri_"$language
echo "Insertion of "$language

echo "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -u$usr -p$pwd

perl $language"/insert_author.pl" $host $db $usr $pwd $language
perl $language"/insert_feat.pl" $host $db $usr $pwd $language
perl $language"/insert_articles.pl" $host $db $usr $pwd $language
perl $language"/ocr.pl" $host $db $usr $pwd $language

# English
language="english"
db="saptagiri_"$language

echo "Insertion of "$language

echo "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -u$usr -p$pwd

perl $language"/insert_author.pl" $host $db $usr $pwd $language
perl $language"/insert_feat.pl" $host $db $usr $pwd $language
perl $language"/insert_articles.pl" $host $db $usr $pwd $language
perl $language"/ocr.pl" $host $db $usr $pwd $language

# Hindi
language="hindi"
db="saptagiri_"$language

echo "Insertion of "$language

echo "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -u$usr -p$pwd

perl $language"/insert_author.pl" $host $db $usr $pwd $language
perl $language"/insert_feat.pl" $host $db $usr $pwd $language
perl $language"/insert_articles.pl" $host $db $usr $pwd $language
perl $language"/ocr.pl" $host $db $usr $pwd $language

# Kannada
language="kannada"
db="saptagiri_"$language

echo "Insertion of "$language

echo "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -u$usr -p$pwd

perl $language"/insert_author.pl" $host $db $usr $pwd $language
perl $language"/insert_feat.pl" $host $db $usr $pwd $language
perl $language"/insert_articles.pl" $host $db $usr $pwd $language
perl $language"/ocr.pl" $host $db $usr $pwd $language

# Sanskrit
language="sanskrit"
db="saptagiri_"$language

echo "Insertion of "$language

echo "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -u$usr -p$pwd

perl $language"/insert_author.pl" $host $db $usr $pwd $language
perl $language"/insert_feat.pl" $host $db $usr $pwd $language
perl $language"/insert_articles.pl" $host $db $usr $pwd $language
perl $language"/ocr.pl" $host $db $usr $pwd $language

# Tamil
language="tamil"
db="saptagiri_"$language

echo "Insertion of "$language

echo "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -u$usr -p$pwd

perl $language"/insert_author.pl" $host $db $usr $pwd $language
perl $language"/insert_feat.pl" $host $db $usr $pwd $language
perl $language"/insert_articles.pl" $host $db $usr $pwd $language
perl $language"/ocr.pl" $host $db $usr $pwd $language
