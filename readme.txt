Требования:
	1) php >= 5.5
	2) mysql 5.6

Настройки MySql:
	Хост: localhost
	Порт: 8889
	Пользователь: root
	Пароль: root

Создать таблицу files:
	CREATE TABLE files (
	    id int NOT NULL AUTO_INCREMENT,
	    name varchar(255),
	    size int,
	    extension varchar(50),
	    modified timestamp not null,
	    PRIMARY KEY (id)
	);


