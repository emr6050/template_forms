/* 
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE
IF NOT EXISTS `form_asq3_02mo`
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

    ageAdjustment   varchar
(1),
	
    /* ASQ-3 total score results */

    communicationScore    int,
    grossMotorScore       int,
    fineMotorScore        int,
    problemSolvingScore   int,
    personalSocialScore   int,

    /* ASQ-3 overall responses */
    response1   boolean,
    comments1   longtext,
    response2   boolean,
    comments2   longtext,
    response3   boolean,
    comments3   longtext,
    response4   boolean,
    comments4   longtext,
    response5   boolean,
    comments5   longtext,
    response6   boolean,
    comments6   longtext,
    response7   boolean,
    comments7   longtext,
    response8   boolean,
    comments8   longtext,

    /* ASQ-3 follow-up actions */
    
    shouldFollowup          boolean,
    followupDelay           int,
    shareResults            boolean,
    referForOptions         boolean,
    referForHearing         boolean,
    referForVision          boolean,
    referForBehave          boolean,
    referToCareProvider     boolean,
    reasonForReferral       longtext,
    referToEarlyInterv      boolean,
    noFurtherAction         boolean,
    other                   boolean,
    otherReasonForReferral  longtext,

    /* form extras */

    notes           longtext,               /* free-text notes */
    /* end of custom form fields */

     PRIMARY KEY
(id)

) ENGINE=InnoDB;
