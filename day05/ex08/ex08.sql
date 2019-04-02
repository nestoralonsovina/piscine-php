select last_name, first_name, DATE_FORMAT(birthdate, "%Y-%m-%d") as `birthdate`
from user_card
where year(birthdate) = 1989
order by last_name asc;
