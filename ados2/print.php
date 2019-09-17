<?php
/*
 * Sports Physical Form created by Jason Morrill: January 2009
 */

include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = "form_ados2";

/** CHANGE THIS name to the name of your form **/
$form_name = "ADOS-2";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "ados2";

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
    Algorithm, Module: <input type="number" name="ados2_algorithm" min="0" value="<?php echo stripslashes($record['ados2_algorithm']);?>" >
  </td></tr>
  <tr><td>
    Social Affect (SA) total: <input type="number" name="sa_total" min="0" value="<?php echo stripslashes($record['sa_total']);?>" >
  </td></tr>
  <tr><td>
    Restricted and Repetitive Behavior (RRB): <input type="number" name="rrb_total" min="0" value="<?php echo stripslashes($record['rrb_total']);?>" >
  </td></tr>
  <tr><td>
    Overall Total (SA + RRB): <?php echo stripslashes($record['rrb_total']) + stripslashes($record['sa_total']);?>
  </td></tr>
  <tr><td>
    ADOS-2 Classification:<br>
    <textarea name="ados2_classification" cols="40" rows="3">
      <?php echo stripslashes($record['ados2_classification']) ?>
    </textarea>
    <br>
    Overall Diagnosis:<br>
    <textarea name="diagnosis" cols="40" rows="3">
      <?php echo stripslashes($record['diagnosis']) ?>
    </textarea>
  </td></tr>
  <tr><td>
    ADOS-2 Comparison Score: <input type="number" name="ados2_comp_score" min="0" max="10" value="<?php echo stripslashes($record['ados2_comp_score']);?>" >
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
