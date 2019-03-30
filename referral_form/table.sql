/* 
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE IF NOT EXISTS `form_referral` (
    /* these fields are common to all forms and should remain intact */
    id bigint(20) NOT NULL auto_increment,
    date datetime default NULL,
    pid bigint(20) default NULL,
    user varchar(255) default NULL,
    groupname varchar(255) default NULL,
    authorized tinyint(4) default NULL,
    activity tinyint(4) default NULL,

    /* these fields are customized to this form */
		
    name_comp       varchar(255),            /* Name of Person Completing Form */
	relation        varchar(255),            /* Relationship to Family */
	inf_cont        varchar(255),            /* Contact Information */
	date_compl      datetime default NULL,   /* Date Completed */
	name_child      varchar(255),            /* Child Name */
	date_birth      datetime default NULL,   /* Birthday */
	Screen_comp     varchar(255),            /* Screening/Monitoring/Evaluations Completed M-CHA-R */
	name_parent1    varchar(255),            /* Parent Name */
	name_parent2    varchar(255),            /* Parent Name */
	address1        longtext,                /* Street Address, City/State/Zip Code */
	address2        longtext,                /* Street Address, City/State/Zip Code */
	pho_dat_time1   longtext,                /* Phone Number(s)BestDay&Time for Contact */
	pho_dat_time2   longtext,                /* Phone Number(s)BestDay&Time for Contact */
	nav_family      varchar(255),              /* Family Navigation "use checkbox instead of -- text on new.php form */
	concern         longtext,               /* Agency staff and/or parent's concern regarding child */
	   
    /* end of custom form fields */
	
	 PRIMARY KEY (id)
) ENGINE=InnoDB;


    