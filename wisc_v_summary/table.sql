/*
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE
IF NOT EXISTS `form_wisc_v`
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

    /* these fields are customized to this form */
    vci_sumScaledScores int,
    vci_composite int,
    vci_percentile int,
    vci_confidence int,

    vsi_sumScaledScores int,
    vsi_composite int,
    vsi_percentile int,
    vsi_confidence int,

    fri_sumScaledScores int,
    fri_composite int,
    fri_percentile int,
    fri_confidence int,

    wmi_sumScaledScores int,
    wmi_composite int,
    wmi_percentile int,
    wmi_confidence int,

    psi_sumScaledScores int,
    psi_composite int,
    psi_percentile int,
    psi_confidence int,

    fsiq_sumScaledScores int,
    fsiq_composite int,
    fsiq_percentile int,
    fsiq_confidence int,

    qri_sumScaledScores int,
    qri_composite int,
    qri_percentile int,
    qri_confidence int,

    awmi_sumScaledScores int,
    awmi_composite int,
    awmi_percentile int,
    awmi_confidence int,

    nvi_sumScaledScores int,
    nvi_composite int,
    nvi_percentile int,
    nvi_confidence int,

    gai_sumScaledScores int,
    gai_composite int,
    gai_percentile int,
    gai_confidence int,

    cpi_sumScaledScores int,
    cpi_composite int,
    cpi_percentile int,
    cpi_confidence int,

    /* end of custom form fields */

    PRIMARY KEY
(id)
) ENGINE=InnoDB;
