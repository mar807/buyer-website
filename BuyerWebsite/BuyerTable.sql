-- Marco Romero
-- April 30, 2019

spool buyer-out.txt

drop table Buyers cascade constraints;

create table Buyers
(cust_name   varchar2(30),
 phone_num   varchar2(13),
 location    varchar2(20),
 type_build  varchar2(20),
 bedrooms    varchar2(6),
 bathrooms   varchar2(6),
 square_foot varchar2(15),
 price_range varchar2(20),
 primary key (cust_name) 
);

spool off
