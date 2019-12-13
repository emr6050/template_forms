/*
 * create a custom table for the form
 *
 * This table NEEDS a UNIQUE name
 */

CREATE TABLE
IF NOT EXISTS `form_vineland_ii`
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
    sub_receptive_raw int,
    sub_receptive_vScale int,
    sub_receptive_conf_interval int,
    sub_receptive_adaptive_level int,
    sub_receptive_age_equivalent int,

    sub_expressive_raw int,
    sub_expressive_vScale int,
    sub_expressive_conf_interval int,
    sub_expressive_adaptive_level int,
    sub_expressive_age_equivalent int,

    sub_written_raw int,
    sub_written_vScale int,
    sub_written_conf_interval int,
    sub_written_adaptive_level int,
    sub_written_age_equivalent int,

    comm_standard int,
    comm_conf_interval int,
    comm_percentile int,
    comm_adaptive_level int,

    sub_personal_raw int,
    sub_personal_vScale int,
    sub_personal_conf_interval int,
    sub_personal_adaptive_level int,
    sub_personal_age_equivalent int,

    sub_domestic_raw int,
    sub_domestic_vScale int,
    sub_domestic_conf_interval int,
    sub_domestic_adaptive_level int,
    sub_domestic_age_equivalent int,

    sub_community_raw int,
    sub_community_vScale int,
    sub_community_conf_interval int,
    sub_community_adaptive_level int,
    sub_community_age_equivalent int,

    daily_life_standard int,
    daily_life_conf_interval int,
    daily_life_percentile int,
    daily_life_adaptive_level int,

    sub_relationships_raw int,
    sub_relationships_vScale int,
    sub_relationships_conf_interval int,
    sub_relationships_adaptive_level int,
    sub_relationships_age_equivalent int,

    sub_playLeisureTime_raw int,
    sub_playLeisureTime_vScale int,
    sub_playLeisureTime_conf_interval int,
    sub_playLeisureTime_adaptive_level int,
    sub_playLeisureTime_age_equivalent int,

    sub_copingSkills_raw int,
    sub_copingSkills_vScale int,
    sub_copingSkills_conf_interval int,
    sub_copingSkills_adaptive_level int,
    sub_copingSkills_age_equivalent int,

    socialization_standard int,
    socialization_conf_interval int,
    socialization_percentile int,
    socialization_adaptive_level int,

    sub_gross_motor_raw int,
    sub_gross_motor_vScale int,
    sub_gross_motor_conf_interval int,
    sub_gross_motor_adaptive_level int,
    sub_gross_motor_age_equivalent int,

    sub_fine_motor_raw int,
    sub_fine_motor_vScale int,
    sub_fine_motor_conf_interval int,
    sub_fine_motor_adaptive_level int,
    sub_fine_motor_age_equivalent int,

    motor_skills_standard int,
    motor_skills_conf_interval int,
    motor_skills_percentile int,
    motor_skills_adaptive_level int,

    composite_standard int,
    composite_conf_interval int,
    composite_percentile int,
    composite_adaptive_level int,

    /* end of custom form fields */

    PRIMARY KEY
(id)
) ENGINE=InnoDB;
