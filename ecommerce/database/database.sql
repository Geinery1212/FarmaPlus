DROP DATABASE IF EXISTS id22281903_farmaplus;

CREATE DATABASE IF NOT EXISTS id22281903_farmaplus CHARACTER SET = 'latin1' COLLATE = 'latin1_spanish_ci';

USE id22281903_farmaplus;

CREATE TABLE usuarios (
    id INT(255) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(20),
    imagenes VARCHAR(255),
    CONSTRAINT pk_usuarios PRIMARY KEY (id),
    CONSTRAINT uq_email UNIQUE (email)
) Engine = InnoDB;

INSERT INTO
    usuarios
VALUES (
        NULL,
        'admin',
        'admin',
        'admin@admin.com',
        '$2y$04$vR.znvSkMTn0ZQZcfifqeu6cg7bItD3r1YLVojR9Q/PDdlQM2l2De',
        'admin',
        NUll
    );

CREATE TABLE categorias (
    id INT(255) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    CONSTRAINT pk_categorias PRIMARY KEY (id)
) Engine = InnoDB;

INSERT INTO
    categorias
VALUES (NULL, 'Antihistamínicos'),
    (NULL, 'Antipiréticos'),
    (NULL, 'Antibióticos'),
    (NULL, 'Analgésicos');

CREATE TABLE productos (
    id INT(255) AUTO_INCREMENT NOT NULL,
    categoria_id INT(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio FLOAT(100, 2) NOT NULL,
    stock INT(255) NOT NULL,
    oferta VARCHAR(2),
    fecha DATE NOT NULL,
    imagen VARCHAR(255),
    CONSTRAINT pk_productos PRIMARY KEY (id),
    CONSTRAINT fk_productos_categorias FOREIGN KEY (categoria_id) REFERENCES categorias (id)
) Engine = InnoDB;

CREATE TABLE pedidos (
    id INT(255) AUTO_INCREMENT NOT NULL,
    usuario_id INT(255) NOT NULL,
    municipio VARCHAR(100) NOT NULL,
    localidad VARCHAR(100) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    referencia TEXT,
    numeroTel VARCHAR(100) NOT NULL,
    coste FLOAT(200, 2) NOT NULL,
    estado VARCHAR(20) NOT NULL,
    fecha DATE,
    hora TIME,
    CONSTRAINT pk_pedidos PRIMARY KEY (id),
    CONSTRAINT pk_pedidos_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
) Engine = InnoDB;

CREATE TABLE lineas_pedidos (
    id INT(255) AUTO_INCREMENT NOT NULL,
    pedido_id INT(255) NOT NULL,
    producto_id INT(255) NOT NULL,
    unidades INT(255) NOT NULL,
    CONSTRAINT pk_lineas_pedidos PRIMARY KEY (id),
    CONSTRAINT fk_linea_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos (id),
    CONSTRAINT fk_linea_producto FOREIGN KEY (producto_id) REFERENCES productos (id)
) Engine = InnoDB;

CREATE TABLE categorias_blog (
    id int(255) auto_increment not null,
    nombre varchar(100),
    CONSTRAINT pk_categorias_blog PRIMARY KEY (id)
) ENGINE = InnoDb;

CREATE TABLE entradas_blog (
    id int(255) auto_increment not null,
    usuario_id int(255) not null,
    categoria_id int(255) not null,
    titulo varchar(255) not null,
    descripcion MEDIUMTEXT,
    resumen MEDIUMTEXT,
    fecha date not null,
    CONSTRAINT pk_entradas_blog PRIMARY KEY (id),
    CONSTRAINT fk_entrada_blog_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios (id),
    CONSTRAINT fk_entrada_blog_categoria FOREIGN KEY (categoria_id) REFERENCES categorias_blog (id) ON DELETE NO ACTION
) ENGINE = InnoDb;