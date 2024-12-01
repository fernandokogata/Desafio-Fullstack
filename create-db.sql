CREATE TABLE niveis
(
	id bigserial primary key,
	nivel varchar(255)
);
CREATE TABLE desenvolvedores
(
  id bigserial primary key,
  nivel_id bigserial REFERENCES niveis (id),
  nome varchar(255),
  sexo char(1),
  data_nascimento date,
  hobby varchar(255)
);