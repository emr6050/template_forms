/* 
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE IF NOT EXISTS `form_redir_questionnaire` (
    /* these fields are common to all forms and should remain intact */
    id bigint(20) NOT NULL auto_increment,
    date datetime default NULL,
    pid bigint(20) default NULL,
    user varchar(255) default NULL,
    groupname varchar(255) default NULL,
    authorized tinyint(4) default NULL,
    activity tinyint(4) default NULL,

    /* these fields are customized to this form */
	relationship      varchar(255) default NULL,
	relationshp_other varchar(255) default NULL,
	child_age         varchar(5) default NULL,
	ethnicity         varchar(255) default NULL,
	eth_other         varchar(255) default NULL,
	week_time         varchar(255) default NULL,
	week_other        varchar(255) default NULL,
	insured           varchar(255) default NULL,
	ins_other         varchar(255) default NULL,
	primary_care      varchar(5) default NULL,
    overall_health    varchar(255) default NULL,
	screened          varchar(5) default NULL,
	screen_no         varchar(255) default NULL,
	screen_doc        varchar(255) default NULL,     
	screen_teach      varchar(255) default NULL,	
	screen_fam        varchar(255) default NULL,	
	screen_other      varchar(255) default NULL,
	screen_note       varchar(255) default NULL,
	serv_birth        varchar(5) default NULL,
	serv_occ          varchar(5) default NULL,
	serv_phys         varchar(5) default NULL,
	serv_speech       varchar(5) default NULL,
	serv_head         varchar(5) default NULL,
	serv_mental       varchar(5) default NULL,
	serv_special      varchar(5) default NULL,
	serv_home         varchar(5) default NULL,
	serv_home_note    varchar(255) default NULL,
	serv_other        varchar(5) default NULL,
	serv_other_note   varchar(255) default NULL,
    zip_code          varchar(10) default NULL,
	adult_gender      varchar(255) default NULL,
	gender_note       varchar(255) default NULL,
	adult_age         varchar(5) default NULL,
	ad_ethnicity      varchar(255) default NULL,
	ad_eth_other      varchar(255) default NULL,	
	rel_status        varchar(255) default NULL,
	work_status       varchar(255) default NULL,	
	education         varchar(255) default NULL,	
	income            varchar(255) default NULL,	
	basic_costs       varchar(255) default NULL,
	support           varchar(255) default NULL,
	comm_call         varchar(255) default NULL,
	comm_res          varchar(255) default NULL,
	parent_abil       varchar(255) default NULL,	
	agencies          varchar(255) default NULL,
	parent_talk       varchar(255) default NULL,

    /* end of custom form fields */

    PRIMARY KEY (id)
) ENGINE=InnoDB;