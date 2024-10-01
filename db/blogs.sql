-- create schema
CREATE SCHEMA blog;

ALTER SCHEMA blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- create tables
create table users(
	id int auto_increment primary key,
	`name` text not null,
  email varchar(255) unique not null,
  `password` text not null
);

create table blogs(
	id int auto_increment primary key,
  author int,
  title text,
  content text,
  tags text,
  final bool default false,
  publishedAt timestamp default current_timestamp(),
  foreign key (author) references users(id)
);

create trigger blogs_update_time
before update on blogs
for each row set new.publishedAt = current_timestamp();
