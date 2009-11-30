delimiter |

create table bans
(
	id int not null auto_increment,
	range_beg bigint not null,
	range_end bigint not null,
	reason text default null,
	untill datetime not null,
	primary key (id),
	unique key (range_beg, range_end)
)
engine=InnoDB|

create table languages
(
	id int not null auto_increment,
	name varchar(50) not null,
	primary key (id)
)
engine=InnoDB|

create table categories
(
	id int not null auto_increment,
	name varchar(50) not null,
	primary key (id)
) 
engine=InnoDB|

create table popdown_handlers
(
	id int not null auto_increment,
	name varchar(50) not null,
	primary key (`id`)
)
engine=InnoDB|

create table stylesheets
(
	id int not null auto_increment,
	name varchar(50) not null,
	primary key (id)
)
engine=InnoDB|

create table groups
(
	id int not null auto_increment,
	`name` varchar(50) not null,
	primary key (id),
	unique key (`name`)
)
engine=InnoDB|

create table upload_handlers
(
	id int not null auto_increment,
	name varchar(50) not null,
	primary key (id)
)
engine = InnoDB|

create table boards
(
	id int not null auto_increment,
	name varchar(16) not null,
	title varchar(50) default null,
	bump_limit int not null,
	force_anonymous bit default null,
	default_name varchar(128) default null,
	with_files bit default null,
	same_upload varchar(32) not null,
	popdown_handler int not null,
	category int not null,
  	primary key (id),
	unique key (name),
	constraint foreign key (category) references categories (id) on delete restrict on update restrict,
	constraint foreign key (popdown_handler) references popdown_handlers (id) on delete restrict on update restrict
)
engine=InnoDB|

create table users
(
	id int not null auto_increment,
	keyword varchar(32) default null,
	posts_per_thread int default null,
	threads_per_page int default null,
	lines_per_post int default null,
	`language` int not null,
	stylesheet int not null,
	rempass varchar(12) default null,
	primary key (id),
	unique key (keyword),
	constraint foreign key (`language`) references languages (id) on delete restrict on update restrict,
	constraint foreign key (stylesheet) references stylesheets (id) on delete restrict on update restrict
)
engine=InnoDB|

create table user_groups
(
	`user` int not null,
	`group` int not null,
	constraint foreign key (`group`) references groups (id),
	constraint foreign key (`user`) references users (id),
	unique key (`user`, `group`)
) 
engine=InnoDB|

create table upload_types
(
	id int not null auto_increment,
	extension varchar(10) not null,
	store_extension varchar(10) default null,
	is_image bit not null,
	upload_handler int not null,
	thumbnail_image varchar(256) default null,
	primary key (id),
	constraint foreign key (upload_handler) references upload_handlers (id) on delete restrict on update restrict,
	unique key (extension)
)
engine=InnoDB|

create table board_upload_types
(
	board int not null,
	upload_type int not null,
	constraint foreign key (board) references boards (id) on delete restrict on update restrict,
	constraint foreign key (upload_type) references upload_types (id) on delete restrict on update restrict,
	unique (board, upload_type)
)
engine=InnoDB|

create table threads
(
	id int not null auto_increment,
	board int not null,
	original_post int default null,
	bump_limit int,
	deleted bit,
	archived bit,
	sage bit,
	with_images bit,
	primary key (id),
	constraint foreign key (board) references boards (id) on delete restrict on update restrict
)
engine=InnoDB|

create table hidden_threads
(
	`user` int,
	thread int,
	unique key (`user`, thread),
	constraint foreign key (`user`) references users (id) on delete restrict on update restrict,
	constraint foreign key (thread) references threads (id) on delete restrict on update restrict
)
engine=InnoDB|

create table uploads
(
	id int not null auto_increment,
	board int not null,	-- TODO Избыточная информация.
	`hash` varchar(32) default null,
	is_image bit not null,
	file_name varchar(256) not null,
	file_w int default null,
	file_h int default null,
	`size` int not null,
	thumbnail_name varchar(256) default null,
	thumbnail_w int default null,
	thumbnail_h int default null,
	primary key (id),
	constraint foreign key (board) references boards (id) on delete restrict on update restrict
)
engine=InnoDB|

create table posts
(
	id int not null auto_increment,
	board int not null,
	thread int not null,
	`number` int not null,
	`user` int not null,
	password varchar(128) default null,
	`name` varchar(128) default null,
	ip bigint default null,
	subject varchar(128) default null,
	date_time datetime default null,
	text text default null,
	sage bit default null,
	deleted bit default null,
	primary key (id),
	constraint foreign key (board) references boards (id) on delete restrict on update restrict,
	constraint foreign key (thread) references threads (id) on delete restrict on update restrict,
	constraint foreign key (`user`) references users (id) on delete restrict on update restrict
)
engine=InnoDB|

create table acl
(
	`group` int default null,
	board int default null,
	thread int default null,
	post int default null,
	`view` bit not null,
	`change` bit not null,
	moderate bit not null,
	unique key (`group`, board, thread, post),
	constraint foreign key (`group`) references groups (id) on delete restrict on update restrict,
	constraint foreign key (board) references boards (id) on delete restrict on update restrict,
	constraint foreign key (thread) references threads (id) on delete restrict on update restrict,
	constraint foreign key (post) references posts (id) on delete restrict on update restrict
)
engine=InnoDB|

create table posts_uploads
(
	post int not null,
	upload int not null,
	unique key (post, upload),
	constraint foreign key (post) references posts (id) on delete restrict on update restrict,
	constraint foreign key (upload) references uploads (id) on delete restrict on update restrict
)
engine=InnoDB|