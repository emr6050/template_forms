<?php
/*
 * Sports Physical Form created by Jason Morrill: January 2009
 */

include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = "form_example";

/** CHANGE THIS name to the name of your form **/
$form_name = "SRS-2 AutoScore Form School-Age";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "example2";

formHeader("Form: ".$form_name);
$returnurl = 'encounter_top.php';

/* load the saved record */
$record = formFetch($table_name, $_GET["id"]);

/* remove the time-of-day from the date fields */
if ($record['form_date'] != "") {
    $dateparts = explode(" ", $record['form_date']);
    $record['form_date'] = $dateparts[0];
}

?>

<html><head>
<?php html_header_show();?>

<!-- supporting javascript code -->
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-min-3-1-1/index.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/textformat.js"></script>

<!-- page styles -->
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
<link rel="stylesheet" href="../../forms/<?php echo $form_folder; ?>/style.css" type="text/css">

</head>

<body class="body_top">

Printed on <?php echo date("F d, Y", time()); ?>

<form method=post action="">
<span class="title"><?php xl($form_name, 'e'); ?></span><br>

<!-- container for the main body of the form -->
<div id="print_form_container">

<div id="print_general">
<table>
  <tr><td>
    Assessment ID: <input id="assessment_id" name="assessment_id" type="text" size="50" maxlength="250" value="<?php echo stripslashes($record['child_name']);?>">
    Child's name: <input id="child_name" name="child_name" type="text" size="50" maxlength="250" value="<?php echo stripslashes($record['child_name']);?>">
    Child's age in years: <input id="child_age" name="child_age" type="text" size="50" maxlength="250" value="<?php echo stripslashes($record['child_age']);?>">
    </td></tr>
    <tr><td>
    Rater's name: <input id="rater_name" name="rater_name" type="text" size="50" maxlength="250" value="<?php echo stripslashes($record['rater_name']);?>">
    Date of rating:
       <input type='text' size='10' class='datepicker' name='form_date' id='form_date'
        value='<?php echo stripslashes($record['form_date']);?>'
        title='<?php xl('yyyy-mm-dd', 'e'); ?>'
        />
    </td></tr>
    <tr><td>
    Signature?
    <input type="radio" id="relation" name="relation" value="mother" <?php if ($record["relation"] == 'mother') {
          echo "CHECKED";
    } ?>>Mother
    /
    <input type="radio" id="relation" name="relation" value="father" <?php if ($record["relation"] == 'father') {
          echo "CHECKED";
    } ?>>Father
    <input type="radio" id="relation" name="relation" value="custodial" <?php if ($record["relation"] == 'custodial') {
          echo "CHECKED";
    } ?>>Other custodial
    <input type="radio" id="relation" name="relation" value="teacher" <?php if ($record["relation"] == 'teacher') {
          echo "CHECKED";
    } ?>>Teacher
    <input type="radio" id="relation" name="relation" value="others" <?php if ($record["relation"] == 'others') {
          echo "CHECKED";
    } ?>>Other specialist
    </td></tr>
    <tr><td>
    Grade: <input name="grade" id="grade" type="text" size="3" maxlength="3" value="<?php echo stripslashes($record['grade']);?>">
    </td></tr>
    <tr><td>
    School or clinic: <input name="school_or_clinic" id="school_or_clinic" type="text" size="75" maxlength="250" value="<?php echo stripslashes($record['school_or_clinic']);?>">
    </td></tr>
</table>
</div>



</div> <!-- end form_container -->

</form>

</body>

<script language="javascript">
window.print();
window.close();
</script>

</html>
