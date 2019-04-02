select upper(last_name) as `NAME`, first_name, subscription.price
from user_card
inner join member
on user_card.id_user = member.id_user_card
inner join subscription
on member.id_sub = subscription.id_sub
where subscription.price > 42
order by last_name, first_name;
