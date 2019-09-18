/* 
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE
IF NOT EXISTS `form_asqse2`
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

    survey_interval int,

    /* ASQ:SE-2 total score results */

    totalPointsP1 int,
    totalPointsP2 int,
    totalPointsP3 int,
    totalPointsP4 int,
    totalScore   int,

    /* ASQ:SE-2 overall responses */
    response1   boolean,
    comments1   longtext,
    response2   boolean,
    comments2   longtext,
    response3   boolean,
    comments3   longtext,

    /* ASQ:SE-2 follow-up referral considerations */

    settingTimeFactors varchar,
    developmentFactors varchar,
    healthFactors varchar,
    familyCultureFactors varchar,
    parentalConcerns varchar,

    /* ASQ:SE-2 follow-up actions */
    
    shouldFollowup          boolean,
    followupDelay           int,
    shareResults            boolean,
    provideEdMaterials      boolean,
    provideClassSupportInfo boolean,
    secondaryCaregiver      boolean,
    cargiverWho             longtext,
    referToEarlyInterv      boolean,
    referForEvaluation      boolean,
    other                   boolean,
    otherFollowupAction     longtext,

    /* form extras */

    notes           longtext,               /* free-text notes */
    /* end of custom form fields */

     PRIMARY KEY
(id)

) ENGINE=InnoDB;
