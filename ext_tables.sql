#
# Table structure for table 'tx_feloginsecurity'
#
CREATE TABLE tx_feloginsecurity (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  user_id int(11) unsigned DEFAULT '0' NOT NULL,
  logintype varchar(2) DEFAULT '0' NOT NULL,
  lastloginattempt int(11) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY user_id (user_id)
);
