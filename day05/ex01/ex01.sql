create table ft_table (id int primary key auto_increment not null, login varchar(11) default 'toto' not null, `group` enum('staff', 'student', 'other') not null, creation_date date not null);
