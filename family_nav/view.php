<?php
/*Agreement for Release of Information Form
 * Mostly copied from:
 * Sports Physical Form
 * @package   OpenEMR
 * @author    Jason Morrill
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @link      http://www.open-emr.org
 */


include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = "form_fam_nav";

/** CHANGE THIS name to the name of your form **/
$form_name = "REDIRECT Family Navigation";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "family_nav";

formHeader("Form: ".$form_name);
$returnurl = 'encounter_top.php';

/* load the saved record */
$record = formFetch($table_name, $_GET["id"]);

/* remove the time-of-day from the date fields */
if ($record['form_date'] != "") {
    $dateparts = explode(" ", $record['form_date']);
    $record['form_date'] = $dateparts[0];
}

if ($record['dob'] != "") {
    $dateparts = explode(" ", $record['dob']);
    $record['dob'] = $dateparts[0];
}

if ($record['sig_date'] != "") {
    $dateparts = explode(" ", $record['sig_date']);
    $record['sig_date'] = $dateparts[0];
}
if ($record['psig_date'] != "") {
    $dateparts = explode(" ", $record['psig_date']);
    $record['psig_date'] = $dateparts[0];
}
if ($record['wsig_date'] != "") {
    $dateparts = explode(" ", $record['wsig_date']);
    $record['wsig_date'] = $dateparts[0];
}
?>

<html><head>
<?php html_header_show();?>

<!-- supporting javascript code -->
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-min-3-1-1/index.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/textformat.js?v=<?php echo $v_js_includes; ?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-datetimepicker-2-5-4/build/jquery.datetimepicker.full.min.js"></script>

<!-- page styles -->
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
<link rel="stylesheet" href="../../forms/<?php echo $form_folder; ?>/style.css?v=<?php echo $v_js_includes; ?>" type="text/css">
<link rel="stylesheet" href="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-datetimepicker-2-5-4/build/jquery.datetimepicker.min.css">

<script language="JavaScript">
// this line is to assist the calendar text boxes
var mypcc = '<?php echo $GLOBALS['phone_country_code'] ?>';

function PrintForm() {
    newwin = window.open("<?php echo "http://".$_SERVER['SERVER_NAME'].$rootdir."/forms/".$form_folder."/print.php?id=".$_GET["id"]; ?>","mywin");
}
</script>

</head>

<body class="body_top">

<?php echo date("F d, Y", time()); ?>

<form method=post action="<?php echo $rootdir;?>/forms/<?php echo $form_folder; ?>/save.php?mode=update&id=<?php echo $_GET["id"];?>" name="my_form">
<span class="title"><?php xl($form_name, 'e'); ?></span><br>

<!-- Save/Cancel links -->
<input type="button" class="save" value="<?php xl('Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="dontsave" value="<?php xl('Don\'t Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="printform" value="<?php xl('Print', 'e'); ?>"> &nbsp;

<!-- container for the main body of the form -->
<div id="form_container">

<div id="general">
  <div class="row">
    <div class="column">
      <?php xl('Demographics', 'e'); ?>
      <?php xl('Child\'s Name', 'e'); ?>	  
      <input id="child_name" name="child_name" type="text" size="50" maxlength="250" 
	  value= <?php echo $result['fname'] . '&nbsp;' . $result['mname'] . '&nbsp;' . $result['lname'];?>><br>
	  <?php xl('Date of Birth:', 'e'); ?>
      <input type='text' size='10' class='datepicker' name='child_dob' id='child_dob'
      value= <?php echo $result['DOB'];?> 
      title='<?php xl('yyyy-mm-dd Date of Birth', 'e'); ?>' /><br>
	  <?php xl ('Child\'s Gender','e');?>
	  <input id="child_gender" name="child_gender" type='text' size='10' /><br>
	  <?php xl ('Race','e');?>
	  <input id="race" name="race type='text' size="50" maxlength="250"  /><br>	
	  <?php xl ('Ethnicity','e');?>
	  <input id="ethnicity" name="ethnicity" type='text' size="50" maxlength="250"  /><br>
	  <?php xl ('Parent/Caregiver Name','e');?>
	  <input id="caregiver" name="caregiver" type='text' size="50" maxlength="250"  /><br>	
	  <?php xl ('Phone Number','e');?>
	  <input id="phone" name="phone" type='text' size="50" maxlength="250"  /><br>	  
	  <?php xl ('Address','e');?>
	  <input id="address" name="address" type='text' size="50" maxlength="250"  /><br>	  
	  
	</div>
    <div class="column">
	</div>
  </div>
</div>
</div> <!-- end form_container -->

<input type="button" class="save" value="<?php xl('Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="dontsave" value="<?php xl('Don\'t Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="printform" value="<?php xl('Print', 'e'); ?>"> &nbsp;

</form>

</body>

<script language="javascript">
// jQuery stuff to make the page a little easier to use

$(document).ready(function(){
    $(".save").click(function() { top.restoreSession(); document.my_form.submit(); });
    $(".dontsave").click(function() { parent.closeTab(window.name, false); });
    $(".printform").click(function() { PrintForm(); });

    $('.datepicker').datetimepicker({
        <?php $datetimepicker_timepicker = false; ?>
        <?php $datetimepicker_showseconds = false; ?>
        <?php $datetimepicker_formatInput = false; ?>
        <?php require($GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php'); ?>
        <?php // can add any additional javascript settings to datetimepicker here; need to prepend first setting with a comma ?>
    });
});

</script>

</html>
