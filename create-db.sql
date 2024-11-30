CREATE TABLE niveis
(
	id integer primary key generated always as identity,
	nivel varchar(255) not null
);
CREATE TABLE desenvolvedores
(
  id integer primary key generated always as identity,
  nivel_id integer REFERENCES niveis (id),
  nome varchar(255),
  sexo char(1),
  data_nascimento date,
  hobby varchar(255)
);