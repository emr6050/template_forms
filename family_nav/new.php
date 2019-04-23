<?php
/*
 //This is an attempt at creating the
 //REDIRECT Questionnaire Form
 //file made by Deborah Schleif 2019-04-18
 //deborah.schleif@marquette.edu
 
 //Much of this file is copied and modified from the "example 2" form:
 * @package   OpenEMR
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @link      http://www.open-emr.org
 
 */

include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS name to the name of your form **/
$form_name = "REDIRECT Family Navigation";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "family_nav";

formHeader("Form: ".$form_name);

$returnurl = 'encounter_top.php';
?>

<html><head>
<?php html_header_show();?>

<!-- other supporting javascript code -->
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
</script>

</head>

<body class="body_top">

<?php echo date("F d, Y", time()); ?>

<form method=post action="<?php echo $rootdir;?>/forms/<?php echo $form_folder; ?>/save.php?mode=new" name="my_form">
<span class="title"><?php xl($form_name, 'e'); ?></span><br>

<!-- Save/Cancel buttons -->
<input type="button" class="save" value="<?php xl('Save', 'e'); ?>"> &nbsp;
<input type="button" class="dontsave" value="<?php xl('Don\'t Save', 'e'); ?>"> &nbsp;

<!--//This line lets us get values from the patient data instead of entering it?/>

<?php $res = sqlStatement("SELECT fname,mname,lname,ss,street,city,state,postal_code,phone_home,DOB,sex,guardiansname,guardianphone,race,ethnicity
FROM patient_data WHERE pid = $pid");
$result = SqlFetchArray($res); ?>

<!-- container for the main body of the form -->
<div id="form_container">

<div id="general">
  <div class="row">
    <div class="column">
      <div class='bold'><?php xl('Demographics', 'e'); ?></div>
      <?php xl('Child\'s Name:', 'e'); ?>	  
      <input id="child_name" name="child_name" type="text" size="50" maxlength="250" 
	  value= "<?php echo $result['fname'] . '&nbsp;' . $result['mname'] . '&nbsp;' . $result['lname'];?>"><br>
	  <?php xl('Date of Birth:', 'e'); ?>
      <input type='text' size='10' class='datepicker' name='child_dob' id='child_dob'
      value= <?php echo $result['DOB'];?> 
      title='<?php xl('yyyy-mm-dd Date of Birth', 'e'); ?>' /><br>
	  <?php xl ('Child\'s Gender:','e');?>
	  <input type='text' id="child_gender" name="child_gender" list="genders" value= <?php echo $result['sex'];?> /><br>		  
	  <datalist id="genders"/>
          <option value = "Unassigned">Other/Unassigned</option>	  
          <option value = "Male" >Male</option>
          <option value = "Female">Female</option>
       </datalist>
	  <?php xl ('Race','e');?>
	  <input id="race" name="race" type='text' size="50" maxlength="250"  
	  value= '<?php echo $result['race']; ?>'><br>		
	  <?php xl ('Ethnicity:','e');?>
	  <input id="ethnicity" name="ethnicity" type='text' size="50" maxlength="250"
	  value= "<?php echo $result['ethnicity']; ?>"><br>	  
	  <?php xl ('Parent/Caregiver Name:','e');?>
	  <input id="caregiver" name="caregiver" type='text' size="50" maxlength="250"  
	  value= '<?php echo $result['guardiansname']; ?>'><br>	
	  <?php xl ('Phone Number:','e');?>
	  <input id="phone" name="phone" type='text' size="50" maxlength="250"
      value= <?php echo $result['phone_home']; ?>><br>	  
	  <?php xl ('Street Address:','e');?>
	  <input id="address" name="address" type='text' size="50" maxlength="250"	  
      value= "<?php echo $result['street']; ?>"><br>
	  <div class='bold'><?php xl('Screening', 'e'); ?></div>
	  <?php xl('Screening Date:', 'e'); ?>
      <input type='text' size='10' class='datepicker' name='screen_date' id='screen_date'
      title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
	  <?php xl('Screening Location:', 'e'); ?>
	  <input id="screen_loc" name="screen_loc" type='text' size="50" maxlength="250"  /><br>
	  <?php xl('Screening Type:', 'e'); ?>
	  <input type='text' id="screen_type" name="screen_type" list="screen_types" /><br>	  
	  <datalist id = "screen_types"/>
        <option value = "" ></option>		
        <option value = "ASQ" >ASQ</option>
        <option value = "ASQ-SE">ASQ-SE</option>
        <option value = "MCHAT">MCHAT</option>
		<option value = "Other">Other</option>
      </datalist>
	  <?php xl('Screening Outcome:', 'e'); ?><br>
        <input type="radio" name="screen_outcome" value = "normal" >Within normal limits</option><br>
        <input type="radio" name="screen_outcome" value = "monitoring">In monitoring zone</option><br>
        <input type="radio" name="screen_outcome" value = "concerning">Concerning and in need of evaluation</option><br>
	</div>
    <div class="column">
	<h1><?php xl('Child Family Navigation Services Offered?', 'e'); ?>&nbsp;
	<input type="checkbox" name="serv_offered" ></input></h1><br>
	<div class='bold'><?php xl('Child Family Navigation Services Provided', 'e'); ?></div>
	<?php xl('Contact Date:', 'e'); ?>	
	<input type='text' size='10' class='datepicker' name='contact_date' id='contact_date'
      title='<?php xl('yyyy-mm-dd', 'e'); ?>' /><br>
	<?php xl('Type of Contact:', 'e'); ?>
	<input type='text' id="contact_type" name="contact_type"size="50" maxlength="250" list="contact_types" /><br>	
	<datalist id = "contact_types">
      <option value = "" >
      <option value = "Home Visit" ><?php xl('Home Visit', 'e'); ?></option>
      <option value = "Telephone"><?php xl('Telephone', 'e'); ?></option>
      <option value = "Collateral Collect"><?php xl('Collateral Collect', 'e'); ?></option>
      <option value = "Letter" ><?php xl('Letter', 'e'); ?></option>
      <option value = "Drop-in"><?php xl('Drop-in', 'e'); ?></option>
      <option value = "No-Show"><?php xl('No-Show', 'e'); ?></option>	  
	  <option value = "Other"><?php xl('Other', 'e'); ?></option>
    </datalist>
	<?php xl('Notes', 'e'); ?><br>
	<textarea name="notes" id="notes" cols="50" rows="6"></textarea>
	<div class='bold'><?php xl('Parent/Sibling Navigation Services Provided', 'e'); ?></div>
	<?php xl('Screening Done:', 'e'); ?>
	<input id="fam_screen" name="fam_screen" type='text' size="50" maxlength="250"  /><br>
	<?php xl('Referrals Made:', 'e'); ?>
	<input id="referrals" name="referrals" type='text' size="50" maxlength="250"  /><br>	
	<?php xl('Notes', 'e'); ?><br>
	<textarea name="fam_notes" id="fam_notes" cols="50" rows="6"></textarea>	
	</div>
  </div>

</div> <!-- end form_container -->

<!-- Save/Cancel buttons -->
<input type="button" class="save" value="<?php xl('Save', 'e'); ?>"> &nbsp;
<input type="button" class="dontsave" value="<?php xl('Don\'t Save', 'e'); ?>"> &nbsp;
</form>

</body>

<script language="javascript">

// jQuery stuff to make the page a little easier to use

$(document).ready(function(){
    $(".save").click(function() { top.restoreSession(); document.my_form.submit(); });
    $(".dontsave").click(function() { parent.closeTab(window.name, false); });

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

