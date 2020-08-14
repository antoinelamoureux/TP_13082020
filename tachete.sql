SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS region (
  region_id INT(11) NOT NULL AUTO_INCREMENT,
  region_description VARCHAR(50) NOT NULL,
  PRIMARY KEY (region_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS territories (
  territory_id VARCHAR(20) NOT NULL,
  territory_description VARCHAR(50) NOT NULL,
  region_id INT(11) NOT NULL,
  PRIMARY KEY (territory_id),
  FOREIGN KEY (region_id) REFERENCES region(region_id)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS employee_territories (
  employee_id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  territory_id VARCHAR(20) NOT NULL,
  PRIMARY KEY (employee_id, territory_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS employees (
  employee_id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  last_name VARCHAR(20) NOT NULL,
  first_name VARCHAR(10) NOT NULL, 
  title VARCHAR(30) NOT NULL, 
  title_courtesy VARCHAR(25) NOT NULL,
  birthdate DATETIME,
  hiredate DATETIME,
  adress VARCHAR(60),
  city VARCHAR(15),
  region VARCHAR(15),
  postal_code VARCHAR(10),
  country VARCHAR(15),
  home_phone VARCHAR(24),
  extension VARCHAR(4),
  notes MEDIUMTEXT,
  reportsto INT(11),
  photopath VARCHAR(255),
  salary FLOAT,
  PRIMARY KEY (employee_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS shippers (
  shippers_id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  compagny_name VARCHAR(40) NOT NULL,
  phone VARCHAR(24) NOT NULL,
  PRIMARY KEY (shippers_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS orders (
  order_id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  compagny_id VARCHAR(5) NOT NULL,
  employee_id INT(11) NOT NULL,
  order_date DATETIME,
  required_date DATETIME,
  shipped_date DATETIME,
  shipvia INT(11),
  freight DECIMAL(10,4),
  ship_name VARCHAR(40),
  ship_address VARCHAR(60),
  ship_city VARCHAR(60),
  ship_region VARCHAR(15),
  ship_postal_code VARCHAR(10),
  ship_country VARCHAR(15),
  PRIMARY KEY (order_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS customers (
  customer_id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  compagny_name VARCHAR(40) NOT NULL,
  contact_name VARCHAR(30) NOT NULL,
  contact_title VARCHAR(30) NOT NULL,
  address VARCHAR(60) NOT NULL,
  city VARCHAR(15) NOT NULL,
  region VARCHAR(15) NOT NULL,
  postal_code VARCHAR(10) NOT NULL,
  country VARCHAR(15) NOT NULL,
  phone VARCHAR(24) NOT NULL,
  fax VARCHAR(24) NOT NULL,
  PRIMARY KEY (customer_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS order_details (
  order_id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  product_id INT(11) NOT NULL,
  unit_price DECIMAL(10,4),
  quantity SMALLINT(2),
  discount DOUBLE(8,0),
  PRIMARY KEY (order_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS products (
  product_id INT(11) unsigned NOT NULL AUTO_INCREMENT,
  product_name VARCHAR(40) NOT NULL,
  supplier_id INT(11),
  category_id INT(11),
  quantity_per_unit VARCHAR(20),
  unit_price DECIMAL(10,4),
  units_in_stock SMALLINT(2),
  units_on_order SMALLINT(2),
  reorder_level SMALLINT(2),
  discontinued BIT(1),
  PRIMARY KEY (product_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS customers_demographics (
  customer_type_id VARCHAR(10) NOT NULL,
  customer_desc MEDIUMTEXT NOT NULL,
  PRIMARY KEY (customer_type_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS customer_demo (
  customer_id VARCHAR(5) NOT NULL,
  customer_type_id VARCHAR(10) NOT NULL,
  PRIMARY KEY (customer_id, customer_type_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS suppliers (
  supplier_id INT(11) NOT NULL AUTO_INCREMENT,
  product_name VARCHAR(40) NOT NULL,
  contact_name VARCHAR(30) NOT NULL,
  contact_title VARCHAR(30) NOT NULL,
  address VARCHAR(60) NOT NULL,
  city VARCHAR(15) NOT NULL,
  region VARCHAR(15) NOT NULL,
  postal_code VARCHAR(10) NOT NULL,
  country VARCHAR(15) NOT NULL,
  phone VARCHAR(24) NOT NULL,
  fax VARCHAR(24) NOT NULL,
  home_page MEDIUMTEXT NOT NULL,
  PRIMARY KEY (supplier_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS categories (
  category_id INT(11) NOT NULL AUTO_INCREMENT,
  category_name VARCHAR(24) NOT NULL,
  description MEDIUMTEXT NOT NULL,
  PRIMARY KEY (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SHOW ENGINE INNODB STATUS;

INSERT INTO orders (compagny_id, employee_id, order_date, required_date, shipped_date, shipvia, 
freight, ship_name, ship_address, ship_city, ship_region, ship_postal_code, ship_country)
VALUES
('1', '1', '2020-01-01 10:10:10', '2020-01-05 08:35:00', '2015-01-08 10:11:00', '5', '500.3589', 
'Antonina', '5 rue de la gare', 'Champigny', 'Europe', '77000', 'France'),
('2', '2', '2018-08-01 09:10:10', '2019-01-08 08:35:00', '2019-01-08 15:08:00', '10', '881.8525', 
'Dumont', '5 avenue du Général Leclerc', 'Jointville', 'Europe', '94000', 'France'),
('3', '3', '2019-02-05 09:10:10', '2019-02-15 09:35:00', '2019-01-09 09:05:00', '55', '555.1145', 
'Lopez', '5 rue Grimault', 'Toulouse', 'Europe', '38000', 'France'),
('4', '4', '2019-07-05 08:10:10', '2019-08-08 11:35:00', '2019-01-09 07:05:00', '8', '869.1545', 
'Chevron', '5 rue Balzac', 'Clermont-Ferrand', 'Europe', '25000', 'France'),
('5', '5', '2017-02-05 08:10:10', '2017-05-01 08:15:00', '2013-02-05 10:09:00', '80', '158.1789', 
'Maria', '5 rue Victor Hugo', 'Nice', 'Europe', '28000', 'France');

INSERT INTO customers (compagny_name, contact_name, contact_title, address, city, region, postal_code, 
country, phone, fax)
VALUES
('Nike', 'Antonina', 'Customer', '5 rue de la gare', 'Champigny', 'Europe', '77000', 'France',
'06895741', '546554564'),
('Converse', 'Dumont', 'Customer', '5 avenue du Général Leclerc', 'Jointville', 'Europe', '94000', 'France',
'06859825', '534686455'),
('Reebok', 'Lopez', 'Customer', '5 rue Grimault', 'Toulouse', 'Europe', '38000', 'France',
'06886952', '758585858')
('Veja', 'Chevron', 'Customer', '5 rue Balzac', 'Clermont', 'Europe', '25000', 'France',
'06725889', '525225522'),
('Adidas', 'Maria', 'Customer', '5 rue Victor Hugo', 'Nice', 'Europe', '28000', 'France',
'06895871', '885254425');

INSERT INTO suppliers (product_name, contact_name, contact_title, address, city, 
region, postal_code, country, phone, fax, home_page)
VALUES
('Ipad', 'Nike', 'Supplier', '10 Main Street', 'Denver', 'CO', '535445', 'US', '05689501', '545445435', 'http://www.nike.com'), 
('Iphone', 'Converse', 'Supplier', '15 Burbon Street', 'Boston', 'MA', '535445', 'US', '05689501', '785445435', 'http://www.converse.com'), 
('Apple watch', 'Reebok', 'Supplier', '8 Paradise Street', 'LA', 'CA', '258913', 'US', '05689501', '955445435', 'http://www.reebok.com'), 
('Ipod', 'Veja', 'Supplier', '10 Rain Street', 'Seattle', 'OR', '47861453', 'US', '05689501', '155445435', 'http://www.veja.com'), 
('Imac', 'Adidas', 'Supplier', '10 Snow Street', 'Baltimore', 'MA', '8212334', 'US', '08214158', '255445435', 'http://www.adidas.com');

INSERT INTO products (product_name, supplier_id, category_id, quantity_per_unit, unit_price, 
units_in_stock, units_on_order, reorder_level, discontinued)
VALUES
('Ipad', '1', '5', '10', '1599.00', '55', '8', '1', b'1'), 
('Iphone', '2', '2', '10', '899.00', '55', '8', '1', b'1'), 
('Apple watch', '3', '5', '10', '599.00', '55', '8', '1', b'1'), 
('Ipod', '4', '8', '2', '199.00', '55', '8', '1',  b'1'), 
('Imac', '5', '5', '9', '2999.00', '55', '8', '1',  b'1');
