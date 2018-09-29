update local_area set level=-1 where id in
(
(select id from (SELECT id from local_area where level=1) a)
);
update local_area set level=1 where id in (464,579);
update local_area set parentId=-2 where id in (591,621,628,634,640);

