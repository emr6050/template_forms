/* 
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE IF NOT EXISTS `form_fam_nav` (
    /* these fields are common to all forms and should remain intact */
    id bigint(20) NOT NULL auto_increment,
    date datetime default NULL,
    pid bigint(20) default NULL,
    user varchar(255) default NULL,
    groupname varchar(255) default NULL,
    authorized tinyint(4) default NULL,
    activity tinyint(4) default NULL,

    /* these fields are customized to this form */
    /* Demographics */	
	child_name      varchar(255) default NULL,
	child_gender    varchar(255) default NULL,	
    child_dob       datetime default NULL,
    race            varchar(255) default NULL,
    ethnicity       varchar(255) default NULL,		
	caregiver       varchar(255) default NULL,
	phone           varchar(20) default NULL,	
	address         varchar(255) default NULL,
    /* Screening */	
    screen_date     datetime default NULL,	
    screen_loc      varchar(255) default NULL,		
    screen_type     varchar(255) default NULL,		
    screen_outcome  varchar(255) default NULL,	
    /* Child Family Navigation Services */	
    serv_offered    varchar(5) default NULL,		
    contact_date    datetime default NULL,
    contact_type    varchar(255) default NULL,
    notes           longtext,               /* free-text notes */
    /* Parent/Sibling Family Navigation Services */
    fam_screen      varchar(255) default NULL,	
    referrals       varchar(255) default NULL,
    fam_notes       longtext, 	

    /* end of custom form fields */

    PRIMARY KEY (id)
) ENGINE=InnoDB;
