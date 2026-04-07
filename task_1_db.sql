-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: task_1_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `b_iblock`
--

DROP TABLE IF EXISTS `b_iblock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_iblock` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIMESTAMP_X` datetime NOT NULL DEFAULT current_timestamp(),
  `IBLOCK_TYPE_ID` varchar(50) NOT NULL,
  `LID` char(2) NOT NULL,
  `CODE` varchar(50) DEFAULT NULL,
  `API_CODE` varchar(50) DEFAULT NULL,
  `REST_ON` char(1) NOT NULL DEFAULT 'N',
  `NAME` varchar(255) NOT NULL,
  `ACTIVE` char(1) NOT NULL DEFAULT 'Y',
  `SORT` int(11) NOT NULL DEFAULT 500,
  `LIST_PAGE_URL` varchar(255) DEFAULT NULL,
  `DETAIL_PAGE_URL` varchar(255) DEFAULT NULL,
  `SECTION_PAGE_URL` varchar(255) DEFAULT NULL,
  `CANONICAL_PAGE_URL` varchar(255) DEFAULT NULL,
  `PICTURE` int(18) DEFAULT NULL,
  `DESCRIPTION` text DEFAULT NULL,
  `DESCRIPTION_TYPE` char(4) NOT NULL DEFAULT 'text',
  `RSS_TTL` int(11) NOT NULL DEFAULT 24,
  `RSS_ACTIVE` char(1) NOT NULL DEFAULT 'Y',
  `RSS_FILE_ACTIVE` char(1) NOT NULL DEFAULT 'N',
  `RSS_FILE_LIMIT` int(11) DEFAULT NULL,
  `RSS_FILE_DAYS` int(11) DEFAULT NULL,
  `RSS_YANDEX_ACTIVE` char(1) NOT NULL DEFAULT 'N',
  `XML_ID` varchar(255) DEFAULT NULL,
  `TMP_ID` varchar(40) DEFAULT NULL,
  `INDEX_ELEMENT` char(1) NOT NULL DEFAULT 'Y',
  `INDEX_SECTION` char(1) NOT NULL DEFAULT 'N',
  `WORKFLOW` char(1) NOT NULL DEFAULT 'Y',
  `BIZPROC` char(1) NOT NULL DEFAULT 'N',
  `SECTION_CHOOSER` char(1) DEFAULT NULL,
  `LIST_MODE` char(1) DEFAULT NULL,
  `RIGHTS_MODE` char(1) DEFAULT NULL,
  `SECTION_PROPERTY` char(1) DEFAULT NULL,
  `PROPERTY_INDEX` char(1) DEFAULT NULL,
  `VERSION` int(11) NOT NULL DEFAULT 1,
  `LAST_CONV_ELEMENT` int(11) NOT NULL DEFAULT 0,
  `SOCNET_GROUP_ID` int(18) DEFAULT NULL,
  `EDIT_FILE_BEFORE` varchar(255) DEFAULT NULL,
  `EDIT_FILE_AFTER` varchar(255) DEFAULT NULL,
  `SECTIONS_NAME` varchar(100) DEFAULT NULL,
  `SECTION_NAME` varchar(100) DEFAULT NULL,
  `ELEMENTS_NAME` varchar(100) DEFAULT NULL,
  `ELEMENT_NAME` varchar(100) DEFAULT NULL,
  `FULLTEXT_INDEX` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ix_iblock_api_code` (`API_CODE`),
  KEY `ix_iblock` (`IBLOCK_TYPE_ID`,`LID`,`ACTIVE`),
  KEY `ix_iblock_code` (`CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_iblock`
--

LOCK TABLES `b_iblock` WRITE;
/*!40000 ALTER TABLE `b_iblock` DISABLE KEYS */;
INSERT INTO `b_iblock` VALUES (1,'2026-04-05 16:46:50','news','s1','corporate_news_s1',NULL,'N','[s1] Новости','Y',500,'#SITE_DIR#/news/','#SITE_DIR#/news/#ID#/','#SITE_DIR#/news/list.php?SECTION_ID=#ID#',NULL,NULL,NULL,'text',24,'Y','N',NULL,NULL,'N','corporate_news_s1','fc6ecc243611b5bdc28f7e78d749ea18','Y','Y','N','N','L',NULL,'S',NULL,NULL,1,0,NULL,NULL,NULL,'Разделы','Раздел','Новости','Новость','N'),(2,'2026-04-05 16:46:51','vacancies','s1','corp_vacancies_s1',NULL,'N','Вакансии','Y',500,'#SITE_DIR#/about/vacancies.php','#SITE_DIR#/about/vacancies.php##ID#',NULL,NULL,NULL,NULL,'text',24,'Y','N',NULL,NULL,'N','corp_vacancies_s1','ca6f47ab6d5e2cc8e804b7edc818715a','Y','N','N','N','L',NULL,'S',NULL,NULL,1,0,NULL,NULL,NULL,'Разделы','Раздел','Вакансии','Вакансия','N');
/*!40000 ALTER TABLE `b_iblock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `b_iblock_section`
--

DROP TABLE IF EXISTS `b_iblock_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_iblock_section` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIMESTAMP_X` datetime NOT NULL DEFAULT current_timestamp(),
  `MODIFIED_BY` int(18) DEFAULT NULL,
  `DATE_CREATE` datetime DEFAULT NULL,
  `CREATED_BY` int(18) DEFAULT NULL,
  `IBLOCK_ID` int(11) NOT NULL,
  `IBLOCK_SECTION_ID` int(11) DEFAULT NULL,
  `ACTIVE` char(1) NOT NULL DEFAULT 'Y',
  `GLOBAL_ACTIVE` char(1) NOT NULL DEFAULT 'Y',
  `SORT` int(11) NOT NULL DEFAULT 500,
  `NAME` varchar(255) NOT NULL,
  `PICTURE` int(18) DEFAULT NULL,
  `LEFT_MARGIN` int(18) DEFAULT NULL,
  `RIGHT_MARGIN` int(18) DEFAULT NULL,
  `DEPTH_LEVEL` int(18) DEFAULT NULL,
  `DESCRIPTION` text DEFAULT NULL,
  `DESCRIPTION_TYPE` char(4) NOT NULL DEFAULT 'text',
  `SEARCHABLE_CONTENT` text DEFAULT NULL,
  `CODE` varchar(255) DEFAULT NULL,
  `XML_ID` varchar(255) DEFAULT NULL,
  `TMP_ID` varchar(40) DEFAULT NULL,
  `DETAIL_PICTURE` int(18) DEFAULT NULL,
  `SOCNET_GROUP_ID` int(18) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ix_iblock_section_1` (`IBLOCK_ID`,`IBLOCK_SECTION_ID`),
  KEY `ix_iblock_section_depth_level` (`IBLOCK_ID`,`DEPTH_LEVEL`),
  KEY `ix_iblock_section_code` (`IBLOCK_ID`,`CODE`),
  KEY `ix_iblock_section_left_margin2` (`IBLOCK_ID`,`LEFT_MARGIN`),
  KEY `ix_iblock_section_right_margin2` (`IBLOCK_ID`,`RIGHT_MARGIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_iblock_section`
--

LOCK TABLES `b_iblock_section` WRITE;
/*!40000 ALTER TABLE `b_iblock_section` DISABLE KEYS */;
/*!40000 ALTER TABLE `b_iblock_section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `b_iblock_element`
--

DROP TABLE IF EXISTS `b_iblock_element`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_iblock_element` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIMESTAMP_X` datetime DEFAULT NULL,
  `MODIFIED_BY` int(18) DEFAULT NULL,
  `DATE_CREATE` datetime DEFAULT NULL,
  `CREATED_BY` int(18) DEFAULT NULL,
  `IBLOCK_ID` int(11) NOT NULL DEFAULT 0,
  `IBLOCK_SECTION_ID` int(11) DEFAULT NULL,
  `ACTIVE` char(1) NOT NULL DEFAULT 'Y',
  `ACTIVE_FROM` datetime DEFAULT NULL,
  `ACTIVE_TO` datetime DEFAULT NULL,
  `SORT` int(11) NOT NULL DEFAULT 500,
  `NAME` varchar(255) NOT NULL,
  `PREVIEW_PICTURE` int(18) DEFAULT NULL,
  `PREVIEW_TEXT` text DEFAULT NULL,
  `PREVIEW_TEXT_TYPE` varchar(4) NOT NULL DEFAULT 'text',
  `DETAIL_PICTURE` int(18) DEFAULT NULL,
  `DETAIL_TEXT` longtext DEFAULT NULL,
  `DETAIL_TEXT_TYPE` varchar(4) NOT NULL DEFAULT 'text',
  `SEARCHABLE_CONTENT` text DEFAULT NULL,
  `WF_STATUS_ID` int(18) DEFAULT 1,
  `WF_PARENT_ELEMENT_ID` int(11) DEFAULT NULL,
  `WF_NEW` char(1) DEFAULT NULL,
  `WF_LOCKED_BY` int(18) DEFAULT NULL,
  `WF_DATE_LOCK` datetime DEFAULT NULL,
  `WF_COMMENTS` text DEFAULT NULL,
  `IN_SECTIONS` char(1) NOT NULL DEFAULT 'N',
  `XML_ID` varchar(255) DEFAULT NULL,
  `CODE` varchar(255) DEFAULT NULL,
  `TAGS` varchar(255) DEFAULT NULL,
  `TMP_ID` varchar(40) DEFAULT NULL,
  `WF_LAST_HISTORY_ID` int(11) DEFAULT NULL,
  `SHOW_COUNTER` int(18) DEFAULT NULL,
  `SHOW_COUNTER_START` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ix_iblock_element_1` (`IBLOCK_ID`,`IBLOCK_SECTION_ID`),
  KEY `ix_iblock_element_4` (`IBLOCK_ID`,`XML_ID`,`WF_PARENT_ELEMENT_ID`),
  KEY `ix_iblock_element_3` (`WF_PARENT_ELEMENT_ID`),
  KEY `ix_iblock_element_code` (`IBLOCK_ID`,`CODE`),
  KEY `ix_iblock_element_name` (`IBLOCK_ID`,`NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_iblock_element`
--

LOCK TABLES `b_iblock_element` WRITE;
/*!40000 ALTER TABLE `b_iblock_element` DISABLE KEYS */;
INSERT INTO `b_iblock_element` VALUES (1,'2026-04-05 16:46:50',1,'2026-04-05 16:46:50',1,1,NULL,'Y','2010-05-28 00:00:00',NULL,500,'Банк переносит дату вступления в действие тарифов на услуги в иностранной валюте',NULL,'Уважаемые клиенты,<br />\nсообщаем Вам, что Банк переносит дату вступления в действие тарифов на услуги для юридических лиц и индивидуальных предпринимателей в иностранной валюте. В связи с этим до даты введения в действие новой редакции тарифов, услуги юридическим лицам и индивидуальным предпринимателям будут оказываться в рамках действующих тарифов. <br />\nИнформация о дате введения новой редакции тарифов будет сообщена дополнительно.','html',NULL,'Уважаемые клиенты,<br />\nсообщаем Вам, что Банк переносит дату вступления в действие тарифов на услуги для юридических лиц и индивидуальных предпринимателей в иностранной валюте. В связи с этим до даты введения в действие новой редакции тарифов, услуги юридическим лицам и индивидуальным предпринимателям будут оказываться в рамках действующих тарифов. <br />\nИнформация о дате введения новой редакции тарифов будет сообщена дополнительно.','html','БАНК ПЕРЕНОСИТ ДАТУ ВСТУПЛЕНИЯ В ДЕЙСТВИЕ ТАРИФОВ НА УСЛУГИ В ИНОСТРАННОЙ ВАЛЮТЕ\r\nУВАЖАЕМЫЕ КЛИЕНТЫ,\r\nСООБЩАЕМ ВАМ, ЧТО БАНК ПЕРЕНОСИТ ДАТУ ВСТУПЛЕНИЯ \r\nВ ДЕЙСТВИЕ ТАРИФОВ НА УСЛУГИ ДЛЯ ЮРИДИЧЕСКИХ ЛИЦ И ИНДИВИДУАЛЬНЫХ ПРЕДПРИНИМАТЕЛЕЙ В ИНОСТРАННОЙ ВАЛЮТЕ. В СВЯЗИ С ЭТИМ ДО ДАТЫ ВВЕДЕНИЯ В ДЕЙСТВИЕ НОВОЙ РЕДАКЦИИ ТАРИФОВ, УСЛУГИ ЮРИДИЧЕСКИМ ЛИЦАМ И ИНДИВИДУАЛЬНЫМ ПРЕДПРИНИМАТЕЛЯМ БУДУТ ОКАЗЫВАТЬСЯ В РАМКАХ ДЕЙСТВУЮЩИХ ТАРИФОВ. \r\nИНФОРМАЦИЯ О ДАТЕ ВВЕДЕНИЯ НОВОЙ РЕДАКЦИИ \r\nТАРИФОВ БУДЕТ СООБЩЕНА ДОПОЛНИТЕЛЬНО.\r\nУВАЖАЕМЫЕ КЛИЕНТЫ,\r\nСООБЩАЕМ ВАМ, ЧТО БАНК ПЕРЕНОСИТ ДАТУ ВСТУПЛЕНИЯ \r\nВ ДЕЙСТВИЕ ТАРИФОВ НА УСЛУГИ ДЛЯ ЮРИДИЧЕСКИХ ЛИЦ И ИНДИВИДУАЛЬНЫХ ПРЕДПРИНИМАТЕЛЕЙ В ИНОСТРАННОЙ ВАЛЮТЕ. В СВЯЗИ С ЭТИМ ДО ДАТЫ ВВЕДЕНИЯ В ДЕЙСТВИЕ НОВОЙ РЕДАКЦИИ ТАРИФОВ, УСЛУГИ ЮРИДИЧЕСКИМ ЛИЦАМ И ИНДИВИДУАЛЬНЫМ ПРЕДПРИНИМАТЕЛЯМ БУДУТ ОКАЗЫВАТЬСЯ В РАМКАХ ДЕЙСТВУЮЩИХ ТАРИФОВ. \r\nИНФОРМАЦИЯ О ДАТЕ ВВЕДЕНИЯ НОВОЙ РЕДАКЦИИ \r\nТАРИФОВ БУДЕТ СООБЩЕНА ДОПОЛНИТЕЛЬНО.',1,NULL,NULL,NULL,NULL,NULL,'N','1','','','346668823',NULL,NULL,NULL),(2,'2026-04-05 16:46:50',1,'2026-04-05 16:46:50',1,1,NULL,'Y','2010-05-27 00:00:00',NULL,500,'Начать работать с системой «Интернет-Клиент» стало еще проще ',NULL,'Наш Банк предлагает своим клиентам Мастер Установки «Интернет-Клиент», который существенно упростит начало работы с системой. Теперь достаточно скачать и запустить Мастер Установки, и все настройки будут произведены автоматически. Вам больше не нужно тратить время на изучение объемных инструкций, или звонить в службу техподдержки, чтобы начать работать с системой.','html',NULL,'Наш Банк предлагает своим клиентам Мастер Установки «Интернет-Клиент», который существенно упростит начало работы с системой. Теперь достаточно скачать и запустить Мастер Установки, и все настройки будут произведены автоматически. Вам больше не нужно тратить время на изучение объемных инструкций, или звонить в службу техподдержки, чтобы начать работать с системой.','text','НАЧАТЬ РАБОТАТЬ С СИСТЕМОЙ «ИНТЕРНЕТ-КЛИЕНТ» СТАЛО ЕЩЕ ПРОЩЕ \r\nНАШ БАНК ПРЕДЛАГАЕТ СВОИМ КЛИЕНТАМ МАСТЕР \r\nУСТАНОВКИ «ИНТЕРНЕТ-КЛИЕНТ», КОТОРЫЙ СУЩЕСТВЕННО УПРОСТИТ НАЧАЛО РАБОТЫ С СИСТЕМОЙ. ТЕПЕРЬ ДОСТАТОЧНО СКАЧАТЬ И ЗАПУСТИТЬ МАСТЕР УСТАНОВКИ, И ВСЕ НАСТРОЙКИ БУДУТ ПРОИЗВЕДЕНЫ АВТОМАТИЧЕСКИ. ВАМ БОЛЬШЕ НЕ НУЖНО ТРАТИТЬ ВРЕМЯ НА ИЗУЧЕНИЕ ОБЪЕМНЫХ ИНСТРУКЦИЙ, ИЛИ ЗВОНИТЬ В СЛУЖБУ ТЕХПОДДЕРЖКИ, ЧТОБЫ НАЧАТЬ РАБОТАТЬ С СИСТЕМОЙ.\r\nНАШ БАНК ПРЕДЛАГАЕТ СВОИМ КЛИЕНТАМ МАСТЕР УСТАНОВКИ «ИНТЕРНЕТ-КЛИЕНТ», КОТОРЫЙ СУЩЕСТВЕННО УПРОСТИТ НАЧАЛО РАБОТЫ С СИСТЕМОЙ. ТЕПЕРЬ ДОСТАТОЧНО СКАЧАТЬ И ЗАПУСТИТЬ МАСТЕР УСТАНОВКИ, И ВСЕ НАСТРОЙКИ БУДУТ ПРОИЗВЕДЕНЫ АВТОМАТИЧЕСКИ. ВАМ БОЛЬШЕ НЕ НУЖНО ТРАТИТЬ ВРЕМЯ НА ИЗУЧЕНИЕ ОБЪЕМНЫХ ИНСТРУКЦИЙ, ИЛИ ЗВОНИТЬ В СЛУЖБУ ТЕХПОДДЕРЖКИ, ЧТОБЫ НАЧАТЬ РАБОТАТЬ С СИСТЕМОЙ.',1,NULL,NULL,NULL,NULL,NULL,'N','2','','','847552514',NULL,NULL,NULL),(3,'2026-04-05 16:46:50',1,'2026-04-05 16:46:50',1,1,NULL,'Y','2010-05-24 00:00:00',NULL,500,'Реорганизация сети отделений Банка ',NULL,'В ближайшее время будет значительно расширен продуктовый ряд и перечень предоставляемых банковских услуг, которые Банк сможет предлагать во всех своих дополнительных офисах. Теперь наши клиенты смогут получить полный перечень услуг в любом из отделений Банка. <br />\nБыло проведено комплексное всестороннее исследование функционирования региональных офисов на предмет соответствия возросшим требованиям. В результате, принято решение о временном закрытии офисов, не соответствующих высоким стандартам и не приспособленных к требованиям растущего бизнеса. Офисы постепенно будут отремонтированы и переоборудованы, станут современными и удобными. <br />\n<br />\nПриносим свои извинения за временно доставленные неудобства. ','html',NULL,'В ближайшее время будет значительно расширен продуктовый ряд и перечень предоставляемых банковских услуг, которые Банк сможет предлагать во всех своих дополнительных офисах. Теперь наши клиенты смогут получить полный перечень услуг в любом из отделений Банка. <br />\nБыло проведено комплексное всестороннее исследование функционирования региональных офисов на предмет соответствия возросшим требованиям. В результате, принято решение о временном закрытии офисов, не соответствующих высоким стандартам и не приспособленных к требованиям растущего бизнеса. Офисы постепенно будут отремонтированы и переоборудованы, станут современными и удобными. <br />\n<br />\nПриносим свои извинения за временно доставленные неудобства. ','html','РЕОРГАНИЗАЦИЯ СЕТИ ОТДЕЛЕНИЙ БАНКА \r\nВ БЛИЖАЙШЕЕ ВРЕМЯ БУДЕТ ЗНАЧИТЕЛЬНО РАСШИРЕН \r\nПРОДУКТОВЫЙ РЯД И ПЕРЕЧЕНЬ ПРЕДОСТАВЛЯЕМЫХ БАНКОВСКИХ УСЛУГ, КОТОРЫЕ БАНК СМОЖЕТ ПРЕДЛАГАТЬ ВО ВСЕХ СВОИХ ДОПОЛНИТЕЛЬНЫХ ОФИСАХ. ТЕПЕРЬ НАШИ КЛИЕНТЫ СМОГУТ ПОЛУЧИТЬ ПОЛНЫЙ ПЕРЕЧЕНЬ УСЛУГ В ЛЮБОМ ИЗ ОТДЕЛЕНИЙ БАНКА. \r\nБЫЛО ПРОВЕДЕНО КОМПЛЕКСНОЕ ВСЕСТОРОННЕЕ \r\nИССЛЕДОВАНИЕ ФУНКЦИОНИРОВАНИЯ РЕГИОНАЛЬНЫХ ОФИСОВ НА ПРЕДМЕТ СООТВЕТСТВИЯ ВОЗРОСШИМ ТРЕБОВАНИЯМ. В РЕЗУЛЬТАТЕ, ПРИНЯТО РЕШЕНИЕ О ВРЕМЕННОМ ЗАКРЫТИИ ОФИСОВ, НЕ СООТВЕТСТВУЮЩИХ ВЫСОКИМ СТАНДАРТАМ И НЕ ПРИСПОСОБЛЕННЫХ К ТРЕБОВАНИЯМ РАСТУЩЕГО БИЗНЕСА. ОФИСЫ ПОСТЕПЕННО БУДУТ ОТРЕМОНТИРОВАНЫ И ПЕРЕОБОРУДОВАНЫ, СТАНУТ СОВРЕМЕННЫМИ И УДОБНЫМИ. \r\n\r\nПРИНОСИМ СВОИ ИЗВИНЕНИЯ ЗА ВРЕМЕННО ДОСТАВЛЕННЫЕ \r\nНЕУДОБСТВА.\r\nВ БЛИЖАЙШЕЕ ВРЕМЯ БУДЕТ ЗНАЧИТЕЛЬНО РАСШИРЕН \r\nПРОДУКТОВЫЙ РЯД И ПЕРЕЧЕНЬ ПРЕДОСТАВЛЯЕМЫХ БАНКОВСКИХ УСЛУГ, КОТОРЫЕ БАНК СМОЖЕТ ПРЕДЛАГАТЬ ВО ВСЕХ СВОИХ ДОПОЛНИТЕЛЬНЫХ ОФИСАХ. ТЕПЕРЬ НАШИ КЛИЕНТЫ СМОГУТ ПОЛУЧИТЬ ПОЛНЫЙ ПЕРЕЧЕНЬ УСЛУГ В ЛЮБОМ ИЗ ОТДЕЛЕНИЙ БАНКА. \r\nБЫЛО ПРОВЕДЕНО КОМПЛЕКСНОЕ ВСЕСТОРОННЕЕ \r\nИССЛЕДОВАНИЕ ФУНКЦИОНИРОВАНИЯ РЕГИОНАЛЬНЫХ ОФИСОВ НА ПРЕДМЕТ СООТВЕТСТВИЯ ВОЗРОСШИМ ТРЕБОВАНИЯМ. В РЕЗУЛЬТАТЕ, ПРИНЯТО РЕШЕНИЕ О ВРЕМЕННОМ ЗАКРЫТИИ ОФИСОВ, НЕ СООТВЕТСТВУЮЩИХ ВЫСОКИМ СТАНДАРТАМ И НЕ ПРИСПОСОБЛЕННЫХ К ТРЕБОВАНИЯМ РАСТУЩЕГО БИЗНЕСА. ОФИСЫ ПОСТЕПЕННО БУДУТ ОТРЕМОНТИРОВАНЫ И ПЕРЕОБОРУДОВАНЫ, СТАНУТ СОВРЕМЕННЫМИ И УДОБНЫМИ. \r\n\r\nПРИНОСИМ СВОИ ИЗВИНЕНИЯ ЗА ВРЕМЕННО ДОСТАВЛЕННЫЕ \r\nНЕУДОБСТВА.',1,NULL,NULL,NULL,NULL,NULL,'N','3','','','1337055006',NULL,NULL,NULL),(4,'2026-04-05 16:46:51',1,'2026-04-05 16:46:51',1,2,NULL,'Y','2010-05-01 00:00:00',NULL,200,'Главный специалист Отдела анализа кредитных проектов региональной сети',NULL,'','html',NULL,'<b>Требования</b> 						 						 \n<p>Высшее экономическое/финансовое образование, опыт в банках топ-100 не менее 3-х лет в кредитном отделе (анализ заемщиков), желателен опыт работы с кредитными заявками филиалов, знание технологий АФХД предприятий, навыки написания экспертного заключения, знание законодательства (в т.ч. Положение ЦБ № 254-П).</p>\n 						 						<b>Обязанности</b> 						 \n<p>Анализ кредитных проектов филиалов Банка, подготовка предложений по структурированию кредитных проектов, оценка полноты и качества формируемых филиалами заключений, выявление стоп-факторов, доработка заявок филиалов в соответствии со стандартами Банка, подготовка заключения (рекомендаций) на КК по заявкам филиалов в части оценки финансово-экономического состояния заемщика, защита проектов на КК Банка, консультирование и методологическая помощь филиалам Банка в части корпоративного кредитования.</p>\n 						 						<b>Условия</b> 						 \n<p> Место работы: М.Парк Культуры. Графики работы: пятидневная рабочая неделя, с 9:00 до 18:00, пт. до 16:45. Зарплата: 50000 руб. оклад + премии, полный соц. пакет,оформление согласно ТК РФ</p>\n ','html','ГЛАВНЫЙ СПЕЦИАЛИСТ ОТДЕЛА АНАЛИЗА КРЕДИТНЫХ ПРОЕКТОВ РЕГИОНАЛЬНОЙ СЕТИ\r\n\r\nТРЕБОВАНИЯ \r\n\r\nВЫСШЕЕ ЭКОНОМИЧЕСКОЕ/ФИНАНСОВОЕ ОБРАЗОВАНИЕ, \r\nОПЫТ В БАНКАХ ТОП-100 НЕ МЕНЕЕ 3-Х ЛЕТ В КРЕДИТНОМ ОТДЕЛЕ (АНАЛИЗ ЗАЕМЩИКОВ), ЖЕЛАТЕЛЕН ОПЫТ РАБОТЫ С КРЕДИТНЫМИ ЗАЯВКАМИ ФИЛИАЛОВ, ЗНАНИЕ ТЕХНОЛОГИЙ АФХД ПРЕДПРИЯТИЙ, НАВЫКИ НАПИСАНИЯ ЭКСПЕРТНОГО ЗАКЛЮЧЕНИЯ, ЗНАНИЕ ЗАКОНОДАТЕЛЬСТВА (В Т.Ч. ПОЛОЖЕНИЕ ЦБ № 254-П). ОБЯЗАННОСТИ \r\n\r\nАНАЛИЗ КРЕДИТНЫХ ПРОЕКТОВ ФИЛИАЛОВ БАНКА, \r\nПОДГОТОВКА ПРЕДЛОЖЕНИЙ ПО СТРУКТУРИРОВАНИЮ КРЕДИТНЫХ ПРОЕКТОВ, ОЦЕНКА ПОЛНОТЫ И КАЧЕСТВА ФОРМИРУЕМЫХ ФИЛИАЛАМИ ЗАКЛЮЧЕНИЙ, ВЫЯВЛЕНИЕ СТОП-ФАКТОРОВ, ДОРАБОТКА ЗАЯВОК ФИЛИАЛОВ В СООТВЕТСТВИИ СО СТАНДАРТАМИ БАНКА, ПОДГОТОВКА ЗАКЛЮЧЕНИЯ (РЕКОМЕНДАЦИЙ) НА КК ПО ЗАЯВКАМ ФИЛИАЛОВ В ЧАСТИ ОЦЕНКИ ФИНАНСОВО-ЭКОНОМИЧЕСКОГО СОСТОЯНИЯ ЗАЕМЩИКА, ЗАЩИТА ПРОЕКТОВ НА КК БАНКА, КОНСУЛЬТИРОВАНИЕ И МЕТОДОЛОГИЧЕСКАЯ ПОМОЩЬ ФИЛИАЛАМ БАНКА В ЧАСТИ КОРПОРАТИВНОГО КРЕДИТОВАНИЯ. УСЛОВИЯ \r\n\r\nМЕСТО РАБОТЫ: М.ПАРК КУЛЬТУРЫ. ГРАФИКИ РАБОТЫ: \r\nПЯТИДНЕВНАЯ РАБОЧАЯ НЕДЕЛЯ, С 9:00 ДО 18:00, ПТ. ДО 16:45. ЗАРПЛАТА: 50000 РУБ. ОКЛАД + ПРЕМИИ, ПОЛНЫЙ СОЦ. ПАКЕТ,ОФОРМЛЕНИЕ СОГЛАСНО ТК РФ',1,NULL,NULL,NULL,NULL,NULL,'N','2','','','1535716109',NULL,NULL,NULL),(5,'2026-04-05 16:46:51',1,'2026-04-05 16:46:51',1,2,NULL,'Y','2010-05-01 00:00:00',NULL,300,'Специалист по продажам розничных банковских продуктов',NULL,'','html',NULL,'<b>Требования</b> 						 						 \n<p>Высшее экономического образования ‚ опыт работы в сфере продаж банковских продуктов‚ опытный пользователь ПК‚ этика делового общения‚ ответственность‚ инициативность‚ активность.</p>\n 						 						<b>Обязанности</b> 						 \n<p>Продажа розничных банковских продуктов, оформление документов.</p>\n 						 						<b>Условия</b> 						 \n<p>Трудоустройство по ТК РФ‚ полный соц. пакет. График работы: пятидневная рабочая неделя. Зарплата: 20000 руб. оклад + премии</p>\n ','html','СПЕЦИАЛИСТ ПО ПРОДАЖАМ РОЗНИЧНЫХ БАНКОВСКИХ ПРОДУКТОВ\r\n\r\nТРЕБОВАНИЯ \r\n\r\nВЫСШЕЕ ЭКОНОМИЧЕСКОГО ОБРАЗОВАНИЯ ‚ ОПЫТ \r\nРАБОТЫ В СФЕРЕ ПРОДАЖ БАНКОВСКИХ ПРОДУКТОВ‚ ОПЫТНЫЙ ПОЛЬЗОВАТЕЛЬ ПК‚ ЭТИКА ДЕЛОВОГО ОБЩЕНИЯ‚ ОТВЕТСТВЕННОСТЬ‚ ИНИЦИАТИВНОСТЬ‚ АКТИВНОСТЬ. ОБЯЗАННОСТИ \r\n\r\nПРОДАЖА РОЗНИЧНЫХ БАНКОВСКИХ ПРОДУКТОВ, \r\nОФОРМЛЕНИЕ ДОКУМЕНТОВ. УСЛОВИЯ \r\n\r\nТРУДОУСТРОЙСТВО ПО ТК РФ‚ ПОЛНЫЙ СОЦ. ПАКЕТ. \r\nГРАФИК РАБОТЫ: ПЯТИДНЕВНАЯ РАБОЧАЯ НЕДЕЛЯ. ЗАРПЛАТА: 20000 РУБ. ОКЛАД + ПРЕМИИ',1,NULL,NULL,NULL,NULL,NULL,'N','3','','','925032528',NULL,NULL,NULL),(6,'2026-04-05 16:46:51',1,'2026-04-05 16:46:51',1,2,NULL,'Y','2010-05-01 00:00:00',NULL,400,'Специалист Отдела андеррайтинга',NULL,'','html',NULL,'<b>Требования</b> 						 						 \n<p>Высшее профессиональное образование, опыт работы от 2 лет в отделе по работе с физическими и юридическими лицами Банков, связанных с анализом платёжеспособности и кредитоспособности физических и юридических лиц.</p>\n 						 						<b>Обязанности</b> 						 \n<p>Проверка соответствия документов, предоставленных клиентами Банка, анализ информации о риске</p>\n 						 						<b>Условия</b> 						 \n<p>Трудоустройство по ТК РФ‚ полный соц. пакет. График работы: пятидневная рабочая неделя. Зарплата: оклад 25000 руб.</p>\n ','html','СПЕЦИАЛИСТ ОТДЕЛА АНДЕРРАЙТИНГА\r\n\r\nТРЕБОВАНИЯ \r\n\r\nВЫСШЕЕ ПРОФЕССИОНАЛЬНОЕ ОБРАЗОВАНИЕ, ОПЫТ \r\nРАБОТЫ ОТ 2 ЛЕТ В ОТДЕЛЕ ПО РАБОТЕ С ФИЗИЧЕСКИМИ И ЮРИДИЧЕСКИМИ ЛИЦАМИ БАНКОВ, СВЯЗАННЫХ С АНАЛИЗОМ ПЛАТЁЖЕСПОСОБНОСТИ И КРЕДИТОСПОСОБНОСТИ ФИЗИЧЕСКИХ И ЮРИДИЧЕСКИХ ЛИЦ. ОБЯЗАННОСТИ \r\n\r\nПРОВЕРКА СООТВЕТСТВИЯ ДОКУМЕНТОВ, ПРЕДОСТАВЛЕННЫХ \r\nКЛИЕНТАМИ БАНКА, АНАЛИЗ ИНФОРМАЦИИ О РИСКЕ УСЛОВИЯ \r\n\r\nТРУДОУСТРОЙСТВО ПО ТК РФ‚ ПОЛНЫЙ СОЦ. ПАКЕТ. \r\nГРАФИК РАБОТЫ: ПЯТИДНЕВНАЯ РАБОЧАЯ НЕДЕЛЯ. ЗАРПЛАТА: ОКЛАД 25000 РУБ.',1,NULL,NULL,NULL,NULL,NULL,'N','4','','','1177477483',NULL,NULL,NULL),(7,'2026-04-05 18:05:54',1,'2026-04-05 18:05:17',1,1,NULL,'Y','2026-04-05 00:00:00',NULL,500,'Моя новость',NULL,'Я сделал сайт и создал новость.','text',NULL,'Я сделал сайт и создал новость.','text','МОЯ НОВОСТЬ\r\nЯ СДЕЛАЛ САЙТ И СОЗДАЛ НОВОСТЬ.\r\nЯ СДЕЛАЛ САЙТ И СОЗДАЛ НОВОСТЬ.',1,NULL,NULL,NULL,NULL,NULL,'N','7','','','0',NULL,NULL,NULL),(9,'2026-04-07 15:38:45',1,'2026-04-07 15:38:45',1,2,NULL,'Y','2026-04-07 00:00:00',NULL,500,'junior PHP',NULL,'','text',NULL,'','text','JUNIOR PHP\r\n\r\n',1,NULL,NULL,NULL,NULL,NULL,'N','9','','','0',NULL,NULL,NULL);
/*!40000 ALTER TABLE `b_iblock_element` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `b_iblock_element_property`
--

DROP TABLE IF EXISTS `b_iblock_element_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_iblock_element_property` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `IBLOCK_PROPERTY_ID` int(11) NOT NULL,
  `IBLOCK_ELEMENT_ID` int(11) NOT NULL,
  `VALUE` text NOT NULL,
  `VALUE_TYPE` char(4) NOT NULL DEFAULT 'text',
  `VALUE_ENUM` int(11) DEFAULT NULL,
  `VALUE_NUM` decimal(18,4) DEFAULT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ix_iblock_element_property_1` (`IBLOCK_ELEMENT_ID`,`IBLOCK_PROPERTY_ID`),
  KEY `ix_iblock_element_property_2` (`IBLOCK_PROPERTY_ID`),
  KEY `ix_iblock_element_prop_enum` (`VALUE_ENUM`,`IBLOCK_PROPERTY_ID`),
  KEY `ix_iblock_element_prop_num` (`VALUE_NUM`,`IBLOCK_PROPERTY_ID`),
  KEY `ix_iblock_element_prop_val` (`VALUE`(50),`IBLOCK_PROPERTY_ID`,`IBLOCK_ELEMENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_iblock_element_property`
--

LOCK TABLES `b_iblock_element_property` WRITE;
/*!40000 ALTER TABLE `b_iblock_element_property` DISABLE KEYS */;
/*!40000 ALTER TABLE `b_iblock_element_property` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-07 16:29:25
