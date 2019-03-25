/*
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE IF NOT EXISTS `form_example` (
    /* these fields are common to all forms and should remain intact */
    id bigint(20) NOT NULL auto_increment,
    date datetime default NULL,
    pid bigint(20) default NULL,
    user varchar(255) default NULL,
    groupname varchar(255) default NULL,
    authorized tinyint(4) default NULL,
    activity tinyint(4) default NULL,

    /* these fields are customized to this form */
    assessment_id    varchar(255),
    gender           char(1),
    child_name       varchar(255),           /* full child name on the form */
    child_age        varchar(4),             /* child age on the form */
    rater_name       varchar(255),           /* full rater name on the form */
    relation         char(1),                /* Did client sign the paper version of the form? */
    form_date        datetime default NULL,  /* date the form was completed by client */
    grade            varchar(3),
    school_or_clinic varchar(255),

    /* end of custom form fields */

    PRIMARY KEY (id)
) ENGINE=InnoDB;
