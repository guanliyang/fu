update area set level=-1 where id in
(
(select id from (SELECT id from area where level=1) a)
);
update area set level=1 where id in (464,579);
update area set parentId=-2 where id in (591,621,628,634,640);