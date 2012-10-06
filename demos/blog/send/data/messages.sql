/*!40014
  set
    @prev_unique_checks = @@unique_checks,
    @prev_foreign_key_checks = @@foreign_key_checks,
    unique_checks = 0,
    foreign_key_checks = 0
*/;
/*!40101
  set
    @prev_character_set_client = @@character_set_client,
    @prev_character_set_connection = @@character_set_connection,
    @prev_character_set_results = @@character_set_results,
    @prev_sql_mode = @@sql_mode,
    character_set_client = utf8,
    character_set_connection = utf8,
    character_set_results = utf8,
    sql_mode = 'no_auto_value_on_zero'
*/;
/*!40111
  set
    @prev_sql_notes = @@sql_notes,
    sql_notes = 0
*/;
drop table if exists `tbl_messages`;

CREATE TABLE `tbl_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

set autocommit = 0;
insert into `tbl_messages` values
  (1,'sdfsdfdsfsfsfsdfs',0,null,null),
  (2,'kk',0,null,null),
  (3,'kkioipi',0,null,null),
  (4,'kkioipi',0,'127.0.0.1',1349449008),
  (5,'kkioipi',0,'127.0.0.1',1349449014),
  (6,'kkioipiasda',0,'127.0.0.1',1349449048),
  (7,'iiii',0,'127.0.0.1',1349449064),
  (8,'jj',0,'127.0.0.1',1349468406),
  (9,'jj',0,'127.0.0.1',1349468814),
  (10,'asf',0,'127.0.0.1',1349470394),
  (11,'asf',0,'127.0.0.1',1349470405),
  (12,'asf',0,'127.0.0.1',1349470435),
  (13,'trhtr',0,'127.0.0.1',1349470463),
  (14,'asf',0,'127.0.0.1',1349470491),
  (15,'asf',0,'127.0.0.1',1349470493),
  (16,'asf',0,'127.0.0.1',1349470493);
commit;
/*!40014
  set
    unique_checks = @prev_unique_checks,
    foreign_key_checks = @prev_foreign_key_checks
*/;
/*!40101
  set
    character_set_client = @prev_character_set_client,
    character_set_connection = @prev_character_set_connection,
    character_set_results = @prev_character_set_results,
    sql_mode = @prev_sql_mode
*/;
/*!40111
  set
    sql_notes = @prev_sql_notes
*/;
