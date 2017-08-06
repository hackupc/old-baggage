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
  deleted timestamp DEFAULT NULL,
  description varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (row, col, created),
  UNIQUE (row, col, deleted)
) CHARACTER SET utf8 COLLATE utf8_bin;
