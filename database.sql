CREATE TABLE categories (
name varchar(50) NOT NULL,
parent varchar(50) DEFAULT NULL,
type int NOT NULL,
description varchar(300) DEFAULT NULL,
status int DEFAULT 0,
position int NOT NULL,
posted_date date NOT NULL,
created date NOT NULL,
created_pk varchar(35) NOT NULL,
created_ip varchar(15) NOT NULL,
updated date NOT NULL,
updated_pk varchar(35) NOT NULL,
updated_ip varchar(15) NOT NULL,
 
constraint category_pk primary key (name)
);
 
-- drop table products;
CREATE TABLE products (
id int NOT NULL,
category_pk varchar(50) NOT NULL,
title varchar(100) NOT NULL,
photo varchar(200) ,
desc1 varchar(100) NOT NULL,
desc2 varchar(100) DEFAULT NULL,
desc3 varchar(100) DEFAULT NULL,
desc4 varchar(100) DEFAULT NULL,
desc5 varchar(100) DEFAULT NULL,
desc6 varchar(100) DEFAULT NULL,
desc7 varchar(100) DEFAULT NULL,
desc8 varchar(100) DEFAULT NULL,
desc9 varchar(100) DEFAULT NULL,
desc10 varchar(100) DEFAULT NULL,
price varchar(10) NOT NULL,
sale varchar(100) DEFAULT NULL,
pricesale varchar(10) DEFAULT NULL,
posted_date date NOT NULL,
created date NOT NULL,
created_pk varchar(35) NOT NULL,
created_ip varchar(15) NOT NULL,
updated date NOT NULL,
updated_pk varchar(35) NOT NULL,
updated_ip varchar(15) NOT NULL,
 
constraint products_pk primary key (id)
);
 
-- drop table messages;
CREATE TABLE messages (
email varchar(50) NOT NULL,
phone varchar(15),
subject varchar(200),
message varchar(4000),
response varchar(4000),
status int default 0,
posted_date timestamp default CURRENT_TIMESTAMP,
created timestamp default CURRENT_TIMESTAMP,
created_pk varchar(35) DEFAULT NULL,
created_ip varchar(15) NOT NULL,
updated timestamp default CURRENT_TIMESTAMP,
updated_pk varchar(35) DEFAULT NULL,
updated_ip varchar(15) NOT NULL
);
 
-- drop table users;
CREATE TABLE users (
email varchar(35) NOT NULL,
password varchar(40) NOT NULL,
fname varchar(255) not null,
lname varchar(255) not null,
phone varchar(255) not null,
address varchar(255),
state varchar(255),
city varchar(255),
code varchar(255),
role varchar(35) default 'user',
status int DEFAULT '0',
visits int DEFAULT '0',
last_login timestamp DEFAULT CURRENT_TIMESTAMP,
created timestamp default CURRENT_TIMESTAMP,
created_ip varchar(15) NOT NULL,
updated timestamp default CURRENT_TIMESTAMP,
updated_ip varchar(15) NOT NULL,
updated_pk varchar(35) NOT NULL,
 
constraint users_pk primary key (email)
);
 
-- drop table orders;
create table orders(
email varchar(255) not null,
first_name varchar(255) not null,
last_name varchar(255) not null,
address varchar(255) not null,
phone varchar(255) not null,
state varchar(255) not null,
city varchar(255) not null,
code varchar(255) not null,
cart varchar(2048) not null,
shipped varchar(5) default 'false',
shipped_date date default null,
 
created timestamp default CURRENT_TIMESTAMP,
updated timestamp default CURRENT_TIMESTAMP
);