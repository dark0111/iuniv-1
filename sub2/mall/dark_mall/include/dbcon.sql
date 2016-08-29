// 관리자 정보

// $supervisorSQL 
drop table itp_supervisor;
create table itp_supervisor (
  no int not null auto_increment,
  lno int default '0',
  name varchar(20) default '',
  id varchar(20) default '',
  pw varchar(20) default '',
  date datetime default '0000-00-00 00:00:00',
  login_date datetime default '0000-00-00 00:00:00',
  logout_date datetime default '0000-00-00 00:00:00',
  ip varchar(15) default '000.000.000.000',
  primary key(no)
);

insert into itp_supervisor(lno, name, id, pw, date, login_date, logout_date, ip)
values('0', '관리자', 'admin', password('0000'), now(), '', '', '127.0.0.1');


// 카테고리 관리자
// $categorySQL
drop table itp_category;
create table itp_category (
  no int not null auto_increment,
  scn varchar(5) default '0',
  wcn int default '1',
  cate_name varchar(50) default '',
  extend_cate_name varchar(255) default '',
  cate_info int default '0',
  cv int default '0',
  ip varchar(15) default '000.000.000.000',
  date datetime default '0000-00-00 00:00:00',
  primary key(no)
);

alter table itp_category add column cv int default '0';


// 상품 등록관리
drop table itp_product;
create table itp_product (
  no int not null auto_increment,
  ccn varchar(5) default '0',
  wcn int default '0',
  extend_cate_name varchar(255) default '',
  company_code varchar(10) default 'ITP0000000',
  product_code varchar(10) default '0000000000',
  product_name varchar(255) default '',
  second_product_name varchar(255) default '',
  product_attention text, 
  sales_product_num int default '100',
  make_in varchar(50) default '',
  made_in varchar(50) default '',
  color_class text,
  price int default '0', 
  point int default '0',
  sale_price int default '0',
  delivery_area varchar(30) default '전국',
  delivery_money int default '0',
  delivery_type varchar(20) default '무료배송',
  delivery_way varchar(30) default '택배',
  delivery_mean_day varchar(50) default '결제 후 4일 (휴일제외)',
  delivery_max_day varchar(50) default '결제 후 6일 (휴일제외)',
  ip varchar(15) default '000.000.000.000',
  date datetime default '0000-00-00 00:00:00',
  primary key(no)
);

alter table itp_product add column user_type int default '2';



// 고객 등록관리
drop table itp_member;
create table itp_member (
  no int not null auto_increment,
  id varchar(15) not null,
  pw varchar(50) not null,
  name varchar(10) not null,
  jumin varchar(14) not null,
  add_1 varchar(150) not null,
  add_2 varchar(150) not null,
  zip_1 int not null,
  zip_2 int not null,
  email varchar(100) not null,
  tel varchar(13) not null,
  fax varchar(13) not null,
  hp varchar(13) not null,
  pw_q varchar(100) not null,
  pw_a varchar(50) not null,
  member_class int default '1',
  ip varchar(15) not null,
  login_date datetime default '0000-00-00 00:00:00',
  date datetime,
  primary key(no)
);

// 우편번호
create table zipcode (
	no int not null,
	zipcode varchar(7) default '',
	sido varchar(20) default '',
	gogun varchar(20) default '',
	dong varchar(20) default '',
	address varchar(100) default '',
	bunji varchar(60) default '',
primary key(no)
);

