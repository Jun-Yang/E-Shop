CREATE TABLE categories (
id INT NOT NULL AUTO_INCREMENT,
name varchar(50) NOT NULL,
parent varchar(50) DEFAULT NULL,
layer INT NOT NULL,
description varchar(300) DEFAULT NULL,
status int DEFAULT 0,
posted_date date NOT NULL,
constraint categories_pk primary key (id)
);
 
-- drop table products;
CREATE TABLE products (
id INT NOT NULL AUTO_INCREMENT,
name varchar(200) NOT NULL,
title varchar(100) NOT NULL,
imagePath varchar(100) NOT NULL,
model_type INT NOT NULL,
model_name varchar(50) NOT NULL,
full_name varchar(250) NOT NULL,
desc1 varchar(100) NOT NULL,
desc2 varchar(100) DEFAULT NULL,
desc3 varchar(100) DEFAULT NULL,
desc4 varchar(100) DEFAULT NULL,
desc5 varchar(100) DEFAULT NULL,
desc6 varchar(100) DEFAULT NULL,
price varchar(10) NOT NULL,
discount INT NULL,
posted_date date NOT NULL,
update_date date NULL,
constraint products_pk primary key (id)
);
 
-- drop table messages;
CREATE TABLE messages (
ID 	INT NOT NULL AUTO_INCREMENT,
email varchar(50) NOT NULL,
phone varchar(15),
subject varchar(200),
message varchar(4000),
response varchar(4000),
status int default 0,
posted_date timestamp default CURRENT_TIMESTAMP,
created_date date NULL,
constraint messages_pk primary key (ID)
);
 
-- drop table users;
CREATE TABLE users (
ID INT NOT NULL AUTO_INCREMENT,
email varchar(35) NOT NULL,
password varchar(40) NOT NULL,
fname varchar(255) not null,
lname varchar(255) not null,
phone varchar(255) not null,
addressLine1 varchar(100) null,
addressLine2 varchar(100) null,
state varchar(255),
city varchar(255),
code varchar(255),
TYPE INT NULL,
role varchar(35) default 'user',
status int DEFAULT '0',
last_login timestamp DEFAULT CURRENT_TIMESTAMP, 
constraint users_pk primary key (ID)
);
 
-- drop table orders;
create table orders(
ID INT NOT NULL AUTO_INCREMENT,
userId INT NOT NULL,
product_id INT NOT NULL,
first_name varchar(50) not null,
last_name  varchar(50) not null,
addressLine1 varchar(100) not null,
addressLine2 varchar(100) not null,
city varchar(50) not null,
province varchar(50) not null,
abbr_province varchar(5) null,
city_code varchar(20) not null,
phone varchar(255) not null,
state varchar(255) not null,
country varchar(20) null,
abbr_country varchar(4) null,
cartId INT null,
shiped varchar(5) default 'false',
shipped_date date default null,
Shipping_Method int,
ship_status varchar(10) default 'false',
constraint orders_pk primary key (ID)
);

create table wishlist(
ID INT NOT NULL AUTO_INCREMENT,
user_id INT NOT NULL,
product_id1 INT NOT NULL,
product_id2 INT NULL,
product_id3 INT NULL,
product_id4 INT NULL,
product_id5 INT NULL,
product_id6 INT NULL,
product_id7 INT NULL,
product_id8 INT NULL,
product_id9 INT NULL,
product_id10 INT NULL,
constraint wishlist_pk primary key (ID)
);



create table invoices(
ID INT NOT NULL AUTO_INCREMENT,
user_id INT NOT NULL,
order_id INT NOT NULL,
invoice_status varchar(10) null,
send_status varchar(10) null,
constraint invoices_pk primary key (ID)
);

create table payments(
ID INT NOT NULL AUTO_INCREMENT,
user_id INT NOT NULL,
order_id INT NOT NULL,
payment_status varchar(10) null,
payment_way varchar(10) null,
payment_details varchar(100) null,
amount varchar(100) null,
pay_date date NOT NULL,
constraint payments_pk primary key (ID)
);

create table carts(
ID INT NOT NULL AUTO_INCREMENT,
user_id INT NOT NULL,
product_id1 INT NOT NULL,
product_id2 INT NULL,
product_id3 INT NULL,
product_id4 INT NULL,
product_id5 INT NULL,
product_id6 INT NULL,
product_id7 INT NULL,
product_id8 INT NULL,
product_id9 INT NULL,
product_id10 INT NULL,
constraint carts_pk primary key (ID)
);
