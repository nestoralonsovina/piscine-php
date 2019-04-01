select * from distrib where distrib.id_distrib in(42, 62, 63, 64, 65, 66, 67, 68, 69, 71, 88, 89, 90) or lower(distrib.name) like '%y%y%' limit 3,5;
