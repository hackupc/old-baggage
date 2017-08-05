-- DROP DATABASE hackupc_baggage;

CREATE DATABASE hackupc_baggage;
USE hackupc_baggage;

CREATE TABLE hupc_users (
  id varchar(25) CHARACTER SET utf8 COLLATE utf8_bin,
  name varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  surname varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id) REFERENCES hupc_positions(id),
  FOREIGN KEY (id) REFERENCES hupc_oldpositions(id)
) CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE hupc_positions (
  row char(1) CHARACTER SET utf8 COLLATE utf8_bin,
  col smallint(6),
  id varchar(25) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  created timestamp DEFAULT CURRENT_TIMESTAMP,
  description varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (row, col),
  FOREIGN KEY (row, col, created) REFERENCES hupc_oldpositions(row, col, created)
) CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE hupc_oldpositions (
  row char(1) CHARACTER SET utf8 COLLATE utf8_bin,
  col smallint(6),
  id varchar(25) CHARACTER SET utf8 COLLATE utf8_bin,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deleted timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  description varchar(250) CHARACTER SET utf8 COLLATE utf8_bin,
  PRIMARY KEY (row, col, created)
) CHARACTER SET utf8 COLLATE utf8_bin;

INSERT INTO hupc_positions
VALUES('A',0,'65429546G',CURRENT_TIMESTAMP,NULL);
INSERT INTO hupc_positions
VALUES('A',1,'54367775J',CURRENT_TIMESTAMP,NULL);
INSERT INTO hupc_positions
VALUES('A',4,'07314367A',CURRENT_TIMESTAMP,NULL);
INSERT INTO hupc_positions
VALUES('B',1,'23936573E',CURRENT_TIMESTAMP,NULL);
INSERT INTO hupc_positions
VALUES('B',2,'11350545H',CURRENT_TIMESTAMP,NULL);
INSERT INTO hupc_positions
VALUES('B',4,'95664333X',CURRENT_TIMESTAMP,NULL);
INSERT INTO hupc_positions
VALUES('C',2,'86345947J',CURRENT_TIMESTAMP,NULL);
INSERT INTO hupc_positions
VALUES('C',3,'37451065S',CURRENT_TIMESTAMP,NULL);
