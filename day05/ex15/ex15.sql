select reverse(right(rebmunenohp, length(rebmunenohp) -1)) as `rebmunenohp` from (select phone_number as `rebmunenohp` from distrib where phone_number like '05%') t;
