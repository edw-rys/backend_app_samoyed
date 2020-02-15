DROP DATABASE IF EXISTS db_fundation_tim;
create database db_fundation_tim;
use db_fundation_tim;

create table user_(
    id_user int auto_increment,
    username varchar(20) not null,
    password varchar(200),
    PRIMARY KEY(id_user)
);


create table nacionality(
    id_nacionality int auto_increment,
    name_nacionality varchar(40),
    PRIMARY KEY(id_nacionality)
)ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

insert into nacionality(id_nacionality,name_nacionality) values
(52,"afgano/afgana"),
(53,"alemán/alemana"),
(57,"árabe/árabe"),
(54,"argentino/argentina"),
(55,"boliviano/boliviana"),
(56,"brasileño/brasileña"),
(58,"canadiense/canadiense"),
(59,"chileno/chilena"),
(60,"colombianocolombiana"),
(61,"ecuatorianoecuatoriana"),
(62,"salvadoreño/salvadoreña"),
(63,"español/española"),
(64,"estadounidense/estadounidense"),
(65,"francésfrancesa"),
(66,"ruso/rusa");

create table cargo(
    id_cargo int auto_increment,
    nombre_cargo varchar(40) not null,
    PRIMARY KEY(id_cargo)
)ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

insert into cargo(id_cargo, nombre_cargo)
values
(101,"GERENTE"),
(102,"TESORERO"),
(103,"VOCAL"),
(104,"SECRETARIA/O"),
(105,"PRESIDENTE"),
(106,"JEFE DE RELACIONES PÚBLICAS");

create table department(
    id_department int auto_increment,
    name_department varchar(40) not null,
    PRIMARY KEY(id_department)
)ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

insert into department(id_department, name_department)
values
(201,"Comité de Ética"),
(202,"Departamento de Ingeniería y Servicio Técnico"),
(204,"Agencia de Inteligencia"),
(205,"Departamento de Logística"),
(206,"Departamentos de Seguridad"),
(207,"Departamentos Científico"),
(208,"Departamentos Móviles"),
(209,"Departamento de Manufactura"),
(210,"Departamento Médico"),
(211,"Asuntos Exteriores"),
(212,"Departamento Administrativo");
create table employee(
    id_employee int auto_increment,
    name varchar(25) not null,
    last_name varchar(25) not null,
    dni varchar(20) not null,
    telf varchar(20) not null,
    birthDate date not null,
    gender varchar(15) not null,
    id_nacionality int not null,
    -- data work
    tipo_de_pago varchar(20) not null,
    salary decimal(20,2) not null,

    -- level academic
    level_academic varchar(20),
    title_academic varchar(20),

    id_cargo int not null,
    id_department int not null,

    date_of_admission date not null,
    created_at date not null,
    update_at datetime on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (id_employee),
    FOREIGN KEY (id_nacionality) REFERENCES nacionality(id_nacionality),
    FOREIGN KEY (id_cargo) REFERENCES cargo(id_cargo),
    FOREIGN KEY (id_department) REFERENCES department(id_department)
)ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

insert into employee ( name,last_name,dni,telf,birthDate,gender,id_nacionality,tipo_de_pago,salary, level_academic,title_academic,id_cargo,id_department,date_of_admission,created_at)
values 
("edw","rys","0952615188", "0996554187","1998-04-20","masculino",61,"mes",542.62,"3","ingeniero",101,207,"2019-12-12",now()),
("Tnx","tim","0952614521", "0996554457","1997-05-20","masculino",56,"mes",642.62,"3","ingeniero",102,208,"2017-12-14",now());
