/* 
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE IF NOT EXISTS `form_ref` (
    /* these fields are common to all forms and should remain intact */
    id bigint(20) NOT NULL auto_increment,
    date datetime default NULL,
    pid bigint(20) default NULL,
    user varchar(255) default NULL,
    groupname varchar(255) default NULL,
    authorized tinyint(4) default NULL,
    activity tinyint(4) default NULL,

    /* these fields are customized to this form */
    relation         varchar(255),
    inf_cont        varchar(255),
    date_compl           datetime default NULL,
    name_child   varchar(255),
    date_birth          datetime default NULL,
    screen_comp  varchar(255),	
    name_parent1  varchar(255),	
    name_parent2  varchar(255),		
    address1          longtext,   	
    address2          longtext,    
    pho1         longtext,    
    pho2         longtext,  
    pho_dat_time1         longtext,    
    pho_dat_time2        longtext,  
    nav_family  varchar(5),		
    concern        longtext, 

    /* end of custom form fields */

    PRIMARY KEY (id)
) ENGINE=InnoDB;
