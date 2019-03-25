/* 
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE IF NOT EXISTS `srs2_profile_preschool` (
    /* these fields are common to all forms and should remain intact */
    id bigint(20) NOT NULL auto_increment,
    date datetime default NULL,
    pid bigint(20) default NULL,
    user varchar(255) default NULL,
    groupname varchar(255) default NULL,
    authorized tinyint(4) default NULL,
    activity tinyint(4) default NULL,

    /* these fields are customized to this form */
    assessment_id         varchar(10),
    rater_name            varchar(10),
    rater_relationship    varchar(10),
    facility              varchar(10),
    form_date             datetime default NULL,
	
    /* SRS-2 total score results */
    srs2_total_raw_score  varchar(255),
    srs2_t_score          varchar(255),
    /* DSM-5 compatible scales */
    dsm5_sci_raw_score    varchar(255),
    dsm5_sci_t_score      varchar(255),
    dsm5_rrb_raw_score    varchar(255),
    dsm5_rrb_t_score      varchar(255),
    /* Treatment subscales */
    subscale_awr_raw_score  varchar(255),
    subscale_awr_t_score    varchar(255),
    subscale_cog_raw_score  varchar(255),
    subscale_cog_t_score    varchar(255),
    subscale_com_raw_score  varchar(255),
    subscale_com_t_score    varchar(255),
    subscale_mot_raw_score  varchar(255),
    subscale_mot_t_score    varchar(255),
    subscale_rrb_raw_score  varchar(255),
    subscale_rrb_t_score    varchar(255),
    
    notes           longtext,               /* free-text notes */
    /* end of custom form fields */

    PRIMARY KEY (id)
) ENGINE=InnoDB;
