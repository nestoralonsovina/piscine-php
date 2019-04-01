select last_name, first_name, date(birthdate) from user_card where year(birthdate) = 1989 order by last_name;
