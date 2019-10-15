/*
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE
IF NOT EXISTS `form_wj`
(
    /* these fields are common to all forms and should remain intact */
    id bigint
(20) NOT NULL auto_increment,
    date datetime default NULL,
    pid bigint
(20) default NULL,
    user varchar
(255) default NULL,
    groupname varchar
(255) default NULL,
    authorized tinyint
(4) default NULL,
    activity tinyint
(4) default NULL,

    /* these fields are customized to this form */
    totalA int,
    verbal_totalB int,
    nonverbal_totalB int,
    totalC int,
    totalD int,

    /* end of custom form fields */

    PRIMARY KEY
(id)
) ENGINE=InnoDB;
