-- Marco Romero

spool Architect-out.text

drop table Architect cascade constraints;

create table Architect 
(arch_name varchar2(30), 
phone_num varchar2(13),
location varchar2(20),
type_build varchar2(20),
bedrooms varchar2(6),
bathrooms varchar2(6),
square_foot varchar2(15),
price_range varchar2(20),
primary key (arch_name)
);

spool off
