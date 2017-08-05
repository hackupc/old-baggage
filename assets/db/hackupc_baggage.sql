-- DROP DATABASE hackupc_baggage;

CREATE DATABASE hackupc_baggage;
USE hackupc_baggage;

CREATE TABLE hupc_positions (
  row char(1) CHARACTER SET utf8 COLLATE utf8_bin,
  col smallint(6),
  id varchar(25) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  name varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  surname varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  created timestamp DEFAULT CURRENT_TIMESTAMP,
  description varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (row, col),
  FOREIGN KEY (id) REFERENCES hupc_oldpositions(id),
  FOREIGN KEY (id, name, surname) REFERENCES hupc_oldpositions(id, name, surname),
  FOREIGN KEY (row, col, created) REFERENCES hupc_oldpositions(row, col, created)
) CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE hupc_oldpositions (
  row char(1) CHARACTER SET utf8 COLLATE utf8_bin,
  col smallint(6),
  id varchar(25) CHARACTER SET utf8 COLLATE utf8_bin,
  name varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  surname varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deleted timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  description varchar(250) CHARACTER SET utf8 COLLATE utf8_bin,
  PRIMARY KEY (row, col, created)
) CHARACTER SET utf8 COLLATE utf8_bin;
