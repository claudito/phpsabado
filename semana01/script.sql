
CREATE TABLE empleado
(

id            int auto_increment PRIMARY KEY,
nombres       varchar(100),
apellidos     varchar(100),
dni           varchar(10),
fechaingreso  date

);

INSERT INTO empleado(nombres,apellidos,dni,fechaingreso)
VALUES
('LUIS AUGUSTO','CLAUDIO PONCE','88990011','2018-09-01'),
('MARIA','TORRES','77889900','2010-09-01');