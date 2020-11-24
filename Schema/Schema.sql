create database moviepass;
use moviepass;

create table if not exists users(
	id_user int not null auto_increment,
    user_role varchar(50),
    username varchar(75),
    pass varchar(50),
    constraint pk_users primary key (id_user)
);

insert into users (user_role, username, pass) values (0, 'user@user.com', '123456'), (1, 'admin@admin.com', '123456');

create table if not exists genres(
	id_genre int not null,
    genre_name varchar(100),
    constraint pk_genre primary key (id_genre)
);

create table if not exists movies(
	id_movie int not null auto_increment,
    title varchar(250),
    original_language varchar(50),
    release_date date,
	popularity varchar(50),
	vote_count int,
	poster_path varchar(250),
	id int,
	backdrop_path varchar(100),
	vote_average float,
	overview varchar(1000),
	trailer varchar(250),
	duration int,
    constraint pk_movies primary key (id_movie)
);

create table if not exists movies_x_genres(
	id_movies_x_genres int not null auto_increment,
    id_genre int,
    id_movie int,
    constraint PK_movies_x_genres primary key (id_movies_x_genres),
    constraint FK_genre foreign key (id_genre) references genres(id_genre) on delete cascade on update cascade,    
    constraint FK_movie foreign key (id_movie) references movies(id_movie) on delete cascade on update cascade    
);


create table if not exists cinemas(
	id_cinema int not null auto_increment,
    cinema_name varchar(50),
    address varchar(50),
    phone_number bigint,
    constraint pk_cinemas primary key (id_cinema)
);

insert into cinemas (cinema_name, address, phone_number) values ('Ambassador', 'Cordoba 2204', '4790909');

create table if not exists room_cinema(
	id_room int not null auto_increment,
    capacity int,
    room_name varchar(50),
    price int,
    id_cinema int,
    constraint pk_room primary key (id_room),
    constraint fk_room_cinema foreign key (id_cinema) references cinemas(id_cinema) on delete cascade on update cascade
);

insert into room_cinema (capacity, room_name, price, id_cinema) values (100, 'Dolby Atmos', 75, 1);

create table if not exists shows(
	id_show int not null auto_increment,
    id_movie int,
    id_room int,
    start_time datetime,
    constraint pk_show primary key (id_show),
    constraint fk_show_movie foreign key (id_movie) references movies(id_movie) on delete cascade on update cascade,
    constraint fk_show_room foreign key (id_room) references room_cinema(id_room) on delete cascade on update cascade
);

create table if not exists tickets(
	id_ticket int not null auto_increment,
    id_show int,
    id_user int,
    price int,
    constraint pk_tickets primary key (id_ticket),
    constraint fk_ticket_show foreign key (id_show) references shows(id_show) on delete cascade on update cascade,
    constraint fk_ticket_user foreign key (id_user) references users(id_user) on delete cascade on update cascade
);


