/* 
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE IF NOT EXISTS `form_info_release` (
    /* these fields are common to all forms and should remain intact */
    id bigint(20) NOT NULL auto_increment,
    date datetime default NULL,
    pid bigint(20) default NULL,
    user varchar(255) default NULL,
    groupname varchar(255) default NULL,
    authorized tinyint(4) default NULL,
    activity tinyint(4) default NULL,

    /* these fields are customized to this form */
	release_to      varchar(5) default NULL,  /*to release to*/
    obtain_from     varchar(5) default NULL,  /*to obtain from*/	
	info_to         varchar(255) default NULL, /*Agency or individual*/
	info_addr       varchar (255) default NULL, /*Address of agency or individual*/
    name            varchar(255) default NULL, /* client name--from the records of */
	other_name      varchar(255) default NULL,  /* other names used */
    dob             datetime default NULL,    /* date of birth */
	purpose_coord   varchar(5) default NULL,  /*for service coordination*/	
	purpose_eval  varchar(5) default NULL,    /*for evalation or diagnosis*/		
	purpose_treat  varchar(5) default NULL,   /*for treatment*/		
	purpose_other  varchar(5) default NULL,   /*for other reason*/	
	purpose_other_text varchar(255)default "N/A", /*specify other reason*/
	type_developmental varchar(5)default NULL, /*developmental disabilities information*/
	type_medical  varchar(5) default NULL, /*medical information*/
	type_hum_serv varchar(5) default NULL, /*human services information*/
	type_educational varchar(5) default NULL, /*educational information*/
	type_other varchar(5) default NULL, /*other type of information to be shared*/
	type_other_text varchar(255) default NULL, /*specify other type of information*/
	spec_monitor varchar(5) default NULL, /*developmental monitoring info*/
	spec_screen varchar(5) default NULL, /*developmental screening info*/
	spec_intake varchar(5) default NULL, /*intake summary information*/
	spec_other varchar(5) default NULL, /*other specific type of information*/
	spec_other_text varchar(255) default NULL, /*specify other information*/
	
	
	date_specified  datetime default NULL,  /* date the client specifiec as expiration date */
    form_date datetime default NULL,  /* date the form was completed by client */
	date_expires datetime default NULL,  /* date the client specifiec as expiration date */


    notes           longtext,               /* free-text notes */
    sig             char(1),                /* Did client sign the paper version of the form? */
    sig_date        datetime default NULL,  /* Date the client signed the form */
	psig             char(1),                /* Did parent sign the paper version of the form? */
    psig_date        datetime default NULL,  /* Date parent signed the form */
	wsig             char(1),                /* Did witness sign the paper version of the form? */
    wsig_date        datetime default NULL,  /* Date witness signed the form */
    /* end of custom form fields */

    PRIMARY KEY (id)
) ENGINE=InnoDB;
