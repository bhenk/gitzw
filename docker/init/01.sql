CREATE DATABASE IF NOT EXISTS `msdata`;
CREATE DATABASE IF NOT EXISTS `gitzw`;
CREATE DATABASE IF NOT EXISTS `gitzw_test`;
GRANT ALL ON `msdata`.* TO 'user'@'%';
GRANT ALL ON `gitzw`.* TO 'user'@'%';
GRANT ALL ON `gitzw_test`.* TO 'user'@'%';