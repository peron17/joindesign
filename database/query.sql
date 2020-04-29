drop table if exists employees;

create table employees (
    `id` int auto_increment primary key,
    `name` varchar(255) not null,
    `salary` int not null
);

insert into employees(name, salary) values('Gavin', 1420);
insert into employees(name, salary) values('Norie', 2006);
insert into employees(name, salary) values('Somya', 2210);
insert into employees(name, salary) values('Waiman', 3000);

select 
	(a.average_a - b.average_b) as diff
from 
(
	select 
		round(tbl_a.total / tbl_a.jml) as average_a
	from (
		select 
			sum(salary) as total,
			count(*) as jml
		from 
			employees
	) tbl_a
) a,
(
	select 
		round(tbl_b.total / tbl_b.jml) as average_b
	from (
		select 
			sum(replace(salary, 0, '')) as total,
			count(*) as jml
		from 
			employees
	) tbl_b
) b