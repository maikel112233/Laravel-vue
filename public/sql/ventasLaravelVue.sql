create database if not exists ventasLaravelVue;
use ventasLaravelVue;

CREATE TABLE categorias (
    id INT PRIMARY KEY NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    descripcion VARCHAR(250),
    condicion BOOLEAN NOT NULL
);

CREATE TABLE articulos (
    id INT PRIMARY KEY NOT NULL,
    idCategoria INT NOT NULL,
    codigo VARCHAR(50),
    nombre VARCHAR(100) NOT NULL,
    stock INT NOT NULL,
    descripcion VARCHAR(250),
    imagen VARCHAR(50),
    estado VARCHAR(20),
    FOREIGN KEY (idCategoria)
        REFERENCES categorias (id)
);

CREATE TABLE personas (
    id INT PRIMARY KEY NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    tipo_doc VARCHAR(20),
    numero_doc VARCHAR(15),
    direccion VARCHAR(70),
    telefono VARCHAR(15),
    email VARCHAR(50)
);

CREATE TABLE ingresos (
    id INT PRIMARY KEY NOT NULL,
    id_proveedor INT NOT NULL,
    tipo_comprobante VARCHAR(20) NOT NULL,
    serie_comprobante VARCHAR(7),
    numero_comprobante VARCHAR(10),
    fecha_hora DATETIME NOT NULL,
    porcentaje DECIMAL(4 , 2 ),
    estado VARCHAR(20),
    FOREIGN KEY (id_proveedor)
        REFERENCES personas (id)
);

CREATE TABLE detalles_ingresos (
    id INT PRIMARY KEY NOT NULL,
    id_ingreso INT NOT NULL,
    id_articulo INT NOT NULL,
    cantidad INT NOT NULL,
    precio_venta DECIMAL(11 , 2 ),
    precio_compra DECIMAL(11 , 2 ),
    fecha_hora DATETIME NOT NULL,
    porcentaje DECIMAL(4 , 2 ),
    estado VARCHAR(20),
    FOREIGN KEY (id_ingreso)
        REFERENCES ingresos (id),
    FOREIGN KEY (id_articulo)
        REFERENCES articulos (id)
);

CREATE TABLE ventas (
    id INT PRIMARY KEY NOT NULL,
    id_cliente INT NOT NULL,
    tipo_comprobante VARCHAR(20),
    serie_comprobante VARCHAR(7),
    numero_comprobante VARCHAR(10),
    fecha_hora DATETIME NOT NULL,
    impuesto DECIMAL(4 , 2 ),
    total_venta DECIMAL(11 , 2 ),
    estado VARCHAR(20),
    FOREIGN KEY (id_cliente)
        REFERENCES personas (id)
);

CREATE TABLE detalles_ventas (
    id INT PRIMARY KEY NOT NULL,
    id_venta INT NOT NULL,
    id_articulo INT NOT NULL,
    cantidad INT,
    impuesto DECIMAL(4 , 2 ),
    precio_venta DECIMAL(11 , 2 ),
    descuento DECIMAL(11 , 2 ),
    FOREIGN KEY (id_venta)
        REFERENCES ventas (id),
    FOREIGN KEY (id_articulo)
        REFERENCES articulos (id)
);


