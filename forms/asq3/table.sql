/* 
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE
IF NOT EXISTS `form_asq3_simple`
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
	
    /* ASQ-3 total score results */

    communicationScore    int,
    grossMotorScore       int,
    fineMotorScore        int,
    problemSolvingScore   int,
    personalSocialScore   int,

    /* ASQ-3 overall responses */
    response1   varchar
(5) default NULL,
    comments1   longtext,
    response2   varchar
(5) default NULL,
    comments2   longtext,
    response3   varchar
(5) default NULL,
    comments3   longtext,
    response4   varchar
(5) default NULL,
    comments4   longtext,
    response5   varchar
(5) default NULL,
    comments5   longtext,
    response6   varchar
(5) default NULL,
    comments6   longtext,
    response7   varchar
(5) default NULL,
    comments7   longtext,
    response8   varchar
(5) default NULL,
    comments8   longtext,

    /* ASQ-3 follow-up actions */
    
    shouldFollowup          varchar
(5) default NULL,
    followupDelay           int,
    shareResults            varchar
(5) default NULL,
    referForOptions         varchar
(5) default NULL,
    referForHearing         varchar
(5) default NULL,
    referForVision          varchar
(5) default NULL,
    referForBehave          varchar
(5) default NULL,
    referToCareProvider     varchar
(5) default NULL,
    reasonForReferral       longtext,
    referToEarlyInterv      varchar
(5) default NULL,
    noFurtherAction         varchar
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
