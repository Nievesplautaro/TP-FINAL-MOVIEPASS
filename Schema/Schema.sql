create database moviepass;
use moviepass;

create table if not exists users(
	id_user int not null auto_increment,
    user_role int,
    username varchar(75),
    pass varchar(50),
    constraint pk_users primary key (id_user)
);

create table if not exists movies(
	id_movie int not null auto_increment,
    title varchar(50),
    original_language varchar(50),
    release_date date,
    constraint pk_movies primary key (id_movie)
);


create table if not exists cinemas(
	id_cinema int not null auto_increment,
    cinema_name varchar(50),
    address varchar(50),
    phone_number int,
    constraint pk_cinemas primary key (id_cinema)
);

create table if not exists room_cinema(
	id_room int not null auto_increment,
    seats_number int,
    id_cinema int,
    constraint pk_room primary key (id_room),
    constraint fk_room_cinema foreign key (id_cinema) references cinemas(id_cinema)
);

create table if not exists shows(
	id_show int not null auto_increment,
    id_movie int,
    id_room int,
    start_time date,
    constraint pk_show primary key (id_show),
    constraint fk_show_movie foreign key (id_movie) references movies(id_movie),
    constraint fk_show_room foreign key (id_room) references room_cinema(id_room)
);

create table if not exists seats(
	id_seat int not null auto_increment,
    seat_row varchar(5),
    seat_number int,
    id_room int,
    constraint pk_seat primary key (id_seat),
    constraint fk_seat_room foreign key (id_room) references room_cinema(id_room)
);

create table if not exists tickets(
	id_ticket int not null auto_increment,
    id_show int,
    id_user int,
    price int,
    constraint pk_tickets primary key (id_ticket),
    constraint fk_ticket_show foreign key (id_show) references shows(id_show),
    constraint fk_ticket_user foreign key (id_user) references users(id_user)
);

create table if not exists seat_x_ticket(
	id_seat_x_ticket int not null auto_increment,
    id_ticket int,
    id_seat int,
    constraint pk_seat_x_ticket primary key (id_seat_x_ticket),
    constraint fk_ticket_seat foreign key (id_ticket) references tickets(id_ticket),
    constraint fk_seat_ticket foreign key (id_seat) references seats(id_seat)
);

