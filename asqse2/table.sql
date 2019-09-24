/* 
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE
IF NOT EXISTS `form_asqse2_simple`
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
    quesInterval    varchar
(5),
    ageAdjustment   varchar
(1),
	
    /* ASQ:SE-2 total score results */

    score_page1   int,
    score_page2   int,
    score_page3   int,
    score_page4   int,
    score_total   int,

    /* ASQ:SE-2 overall responses */
    response1   varchar
(5) default NULL,
    comments1   longtext,
    response2   varchar
(5) default NULL,
    comments2   longtext,
    response3   varchar
(5) default NULL,
    comments3   longtext,

    /* ASQ:SE-2 follow-up considerations */

    f_consider_settingTime      varchar
(5) default NULL,
    f_consider_devlopmental     varchar
(5) default NULL,
    f_consider_health           varchar
(5) default NULL,
    f_consider_familyCultural   varchar
(5) default NULL,
    f_consider_parentConcerns   varchar
(5) default NULL,

    /* ASQ:SE-2 follow-up actions */
    
    shouldFollowup          varchar
(5) default NULL,
    followupDelay           int,
    shareResults            varchar
(5) default NULL,
    provideEduMat         varchar
(5) default NULL,
    provideInfo         varchar
(5) default NULL,
    repeatDiffCaregiver     varchar
(5) default NULL,
    diffCaregiver           longtext,
    doDevelopScreen          varchar
(5) default NULL,
    referToSpecialEd     varchar
(5) default NULL,
    referForEvaluation      varchar
(5) default NULL,
    other                   varchar
(5) default NULL,
    otherReasonForReferral  longtext,

    /* form extras */

    notes           longtext,               /* free-text notes */
    /* end of custom form fields */

     PRIMARY KEY
(id)

) ENGINE=InnoDB;
