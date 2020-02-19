<?php
function dataTypes($type, $param = null)
{
	$arr = [
		'TINYINT' => 'TINYINT(4)',
		'UNSIGNED TINYINT' => 'TINYINT(3) UNSIGNED',
		'SMALLINT' => 'SMALLINT(6)',
		'UNSIGNED SMALLINT' => 'SMALLINT(5) UNSIGNED',
		'MEDIUMINT' => 'MEDIUMINT(9)',
		'UNSIGNED MEDIUMINT' => 'MEDIUMINT(8) UNSIGNED',
		'INT' => 'INT(11)',
		'UNSIGNED INT' => 'INT(10) UNSIGNED',
		'BIGINT' => 'BIGINT(20)',
		'UNSIGNED BIGINT' => 'BIGINT(20) UNSIGNED',
		'ipAddress' => 'ipAddress',
		'macAddress' => 'macAddress',
		'uuid' => 'uuid',
		'DECIMAL' => 'DECIMAL(param)',
		'unsignedDecimal' => 'DECIMAL(param) UNSIGNED',
		'FLOAT' => 'DECIMAL(param)',
		'DOUBLE' => 'DOUBLE',
		'REAL' => 'REAL',
		'BOOLEAN' => 'BOOLEAN',
		'SERIAL' => 'SERIAL',
		'DATE' => 'DATE',
		'DATETIME' => 'DATETIME',
		'TIMESTAMP' => 'TIMESTAMP',
		'TIME' => 'TIME',
		'YEAR' => 'YEAR(param)',
		'CHAR' => 'CHAR(param)',
		'VARCHAR' => 'VARCHAR(param)',
		'TINYTEXT' => 'TINYTEXT',
		'TEXT' => 'TEXT',
		'MEDIUMTEXT' => 'MEDIUMTEXT',
		'LONGTEXT' => 'LONGTEXT',
		'BINARY' => 'BINARY(param)',
		'VARBINARY' => 'VARBINARY(param)',
		'TINYBLOB' => 'TINYBLOB',
		'MEDIUMBLOB' => 'MEDIUMBLOB',
		'BLOB' => 'BLOB',
		'LONGBLOB' => 'LONGBLOB',
		'ENUM' => 'ENUM(param)',
		'SET' => 'SET(param)',
		'GEOMETRY' => 'GEOMETRY',
		'POINT' => 'POINT',
		'LINESTRING' => 'LINESTRING',
		'POLYGON' => 'POLYGON',
		'MULTIPOINT' => 'MULTIPOINT',
		'MULTILINESTRING' => 'MULTILINESTRING',
		'MULTIPOLYGON' => 'MULTIPOLYGON',
		'GEOMETRYCOLLECTION' => 'GEOMETRYCOLLECTION',
		'INCREMENTS' => 'INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
		'TINY INCREMENTS' => 'TINYINT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
		'SMALL INCREMENTS' => 'SMALLINT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
		'MEDIUM INCREMENTS' => 'MEDIUMINT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
		'BIG INCREMENTS' => 'BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
		'created_at_timestamp' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
		'updated_at_timestamp' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
	];
	return str_replace('param',$param,$arr[$type])??'varchar(255)';
}
?>