INSERT INTO ft_table(login, groupe, creation_date) SELECT last_name, 'other', birthdate FROM  user_card WHERE last_name LIKE '%a%' AND LENGTH(last_name) < 9 ORDER BY last_name LIMIT 10;
