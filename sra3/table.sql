/* 
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE
IF NOT EXISTS `form_sra2`
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

    /* start of custom form fields */
    test_date   datetime default NULL,
    child_dob   datetime default NULL,
	
    /* score results */

    colors_raw      int,
    colors_mastery  int,
    color_comments  longtext,
    letters_raw      int,
    letters_mastery  int,
    letters_comments  longtext,
    numbers_raw      int,
    numbers_mastery  int,
    numbers_comments  longtext,
    sizeCompare_raw      int,
    sizeCompare_mastery  int,
    sizeCompare_comments  longtext,
    shapes_raw      int,
    shapes_mastery  int,
    shapes_comments  longtext,

    /* score composite */

    src_raw int,
    src_mastery int,
    src_standard int,
    src_conf_level int,
    src_conf_lower int,
    src_conf_upper int,
    src_perc_rank int,
    src_desc_class longtext,
    src_age_eq longtext,

    /* form extras */

    notes           longtext,               /* free-text notes */
    /* end of custom form fields */

     PRIMARY KEY
(id)

) ENGINE=InnoDB;
