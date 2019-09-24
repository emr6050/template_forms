<?php
include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = "form_adi_r_simple";

/** CHANGE THIS name to the name of your form **/
$form_name = "Autism Diagnostic Interview-Revised";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "adi_r";

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
    Total A: <input type="number" name="totalA" min="0" value="<?php echo stripslashes($record['totalA']);?>" >
  </td></tr>
  <tr><td>
    Verbal Total B: <input type="number" name="verbal_totalB" min="0" value="<?php echo stripslashes($record['verbal_totalB']);?>" >
  </td></tr>
  <tr><td>
    Nonverbal Total B: <input type="number" name="nonverbal_totalB" min="0" value="<?php echo stripslashes($record['nonverbal_totalB']);?>" >
  </td></tr>
  <tr><td>
    Total C: <input type="number" name="totalC" min="0" value="<?php echo stripslashes($record['totalC']);?>" >
  </td></tr>
  <tr><td>
    Total D: <input type="number" name="totalD" min="0" value="<?php echo stripslashes($record['totalD']);?>" >
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
