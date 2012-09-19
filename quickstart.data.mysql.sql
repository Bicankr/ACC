-- Adminer 3.4.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `task` (`id`, `text`, `created`, `done`, `user_id`, `tasklist_id`) VALUES
(1,	'Provést analýzu',	'2011-12-06 12:30:00',	1,	2,	1),
(2,	'Implementace úkolníčku',	'2011-12-06 12:35:50',	0,	3,	1),
(3,	'Sepsání dokumentace',	'2011-12-07 16:23:30',	0,	2,	1),
(4,	'Opravit chybu #42',	'2011-12-10 16:10:40',	0,	3,	2),
(5,	'Zavolat klientovi',	'2011-12-10 17:44:32',	0,	2,	2),
(6,	'SWOT analýza',	'2011-12-12 10:42:31',	0,	2,	3),
(7,	'Analýza trhu',	'2011-12-12 10:53:13',	0,	3,	3),
(8,	'Opravit chybu #51',	'2011-12-12 14:10:05',	0,	3,	2),
(9,	'Nastavení serveru',	'2011-12-13 17:52:14',	0,	2,	3),
(10,	'Benchmark nového stroje',	'2011-12-15 11:21:52',	1,	2,	3);

INSERT INTO `tasklist` (`id`, `title`) VALUES
(1,	'Projekt A'),
(2,	'Projekt B'),
(3,	'Projekt C');

INSERT INTO `user` (`id`, `username`, `password`, `name`) VALUES
(1,	'admin',	'$2a$07$e53792f10633ef0287096upIgQt7Jm07MY.x/LzhlAbDU8mwS7ruC',	'Administrátor'),
(2,	'pepa',	'$2a$07$e6c4be816bcbb233bb9a6u1PU8tlS0B4MupR5u/9/IqyFHjC3dl06',	'Josef Novák'),
(3,	'franta',	'$2a$07$5943a502b989b22e1fe76udHamCevD7lekFrrwLA5AICeL.bP8vnW',	'František Novotný');

-- 2012-08-03 17:01:31
