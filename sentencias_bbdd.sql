create table usuario ( usuario_id int auto_increment, denominacion char(14) not null, clave varchar(8) not null, nombre char(20) not null, apellido char(30) not null, activo bool, PRIMARY KEY usuario_identidad (usuario_id) );
create table cliente (
    cliente_id int auto_increment,
    documento char(15) not null unique,
    nombre char(20) not null,
    apellido char(30) not null,
    fecha_nacimiento date not null,
    direccion varchar(70) not null,
    telefono varchar(14) not null,
    celular varchar(12) not null,
    estado char(10) not null check (estado in ("Activo", "Inactivo", "Moroso", "Suspendido")),
    PRIMARY KEY cliente_identidad (cliente_id)
    );
create table pelicula (
    pelicula_id int auto_increment,
    titulo varchar(40) not null,
    genero varchar(15) not null,
    año char(4) not null,
    director varchar(20) not null,
    formato char(3) not null check (formato in ("VHS", "DVD", "BRY", "VCD")),
    precio_alquiler int not null,
    PRIMARY KEY pelicula_identidad (pelicula_id)
    );
create table alquiler (
    alquiler_id int auto_increment,
    cliente_id int not null,
    pelicula_id int not null,
    fecha_alquiler date not null,
    situacion char(8) default "Vigente" not null check(situacion in ("Vigente", "Prorroga", "Mora")),
    creado_por int not null,
    modificado_por int not null,
    PRIMARY KEY alquiler_identidad (alquiler_id)
    );

ALTER TABLE alquiler
ADD CONSTRAINT pelicula_alquilada_fk
FOREIGN KEY (pelicula_id)
REFERENCES pelicula(pelicula_id);

ALTER TABLE alquiler
ADD CONSTRAINT cliente_que_alquila_fk
FOREIGN KEY (cliente_id)
REFERENCES cliente(cliente_id);

ALTER TABLE alquiler
ADD CONSTRAINT usuario_que_crea_fk
FOREIGN KEY (creado_por)
REFERENCES usuario(usuario_id);

ALTER TABLE alquiler
ADD CONSTRAINT usuario_que_modifica_fk
FOREIGN KEY (modificado_por)
REFERENCES usuario(usuario_id);

create procedure insert_alquiler_sp(in cliente_id int, in pelicula_id int, in fecha_alquiler date, in situacion char(8), in creado_por int, in modificado_por int)
begin
	insert into alquiler (cliente_id, pelicula_id, fecha_alquiler, situacion, creado_por, modificado_por) values (cliente_id, pelicula_id, fecha_alquiler, situacion, creado_por, modificado_por);
end