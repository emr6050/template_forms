<?php
/*
 
 //Much of this file is copied and modified from:
 * Sports Physical Form created by Jason Morrill: January 2009
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

if ($record['screen_date'] != "") {
    $dateparts = explode(" ", $record['screen_date']);
    $record['screen_date'] = $dateparts[0];
}

if ($record['contact_date'] != "") {
    $dateparts = explode(" ", $record['contact_date']);
    $record['contact_date'] = $dateparts[0];
}
?>
<!--//This line lets us get values from the patient data instead of entering it?/>

<?php $res = sqlStatement("SELECT fname,mname,lname,ss,street,city,state,postal_code,phone_home,DOB FROM patient_data WHERE pid = $pid");
$result = SqlFetchArray($res); ?>

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

<div id="form_container">
<div id="general">
  <div class="row">
    <div class="column">
      <div class='bold'><?php xl('Demographics', 'e'); ?></div>
      <?php xl('Child\'s Name:', 'e'); ?>  
      <input id="child_name" name="child_name" type="text" size="45" maxlength="250" 
	  value="<?php echo stripslashes($record['child_name']);?>"><br>
	  <?php xl('Date of Birth:', 'e'); ?>
      <input type='text' size='10' class='datepicker' name='child_dob' id='child_dob'
      value=<?php echo stripslashes($record['child_dob']);?> 
      title='<?php xl('yyyy-mm-dd Date of Birth', 'e'); ?>' /><br>
	  <?php xl ('Child\'s Gender:','e');?>
      <input type='text' id="child_gender" name="child_gender" list="genders" value=<?php echo stripslashes($record['child_gender']);?> /><br>	  
	  <datalist id="genders"/>
        <option value = "Unassigned">Other/Unassigned</option>	  
        <option value = "Male"  > Male</option>
        <option value = "Female">Female</option>
       </datalist>		   
	  <?php xl ('Race','e');?>
	  <input id="race" name="race" type='text' size="45" maxlength="250" list="races" 
	  value= '<?php echo $record['race']; ?>'><br>
	  <datalist id="races"/>
          <option value = "Black or African American or Caribbean"><?php xl('Black or African American or Caribbean','e');?></option>	  
          <option value = "White" ><?php xl('White','e');?></option>
          <option value = "Asian"><?php xl('Asian','e');?></option>
          <option value = "Hispanic or Latino"><?php xl('Hispanic or Latino','e');?></option>	  
          <option value = "Native American" ><?php xl('Native American','e');?></option>
          <option value = "Native Hawaiian or Pacific Islander'"><?php xl('Native Hawaiian or Pacific Islander','e');?></option>	  
       </datalist>	 	  
	  <?php xl ('Ethnicity:','e');?>
	  <input id="ethnicity" name="ethnicity" type='text' size="45" maxlength="250" value= '<?php echo $record['ethnicity']; ?>'><br>	  
	  <?php xl ('Parent/Caregiver Name:','e');?>
	  <input id="caregiver" name="caregiver" type='text' size="45" maxlength="250"  
	  value= '<?php echo stripslashes($record['caregiver']); ?>'><br>	
	  <?php xl ('Phone Number:','e');?>
	  <input id="phone" name="phone" type='text' size="45" maxlength="250"
      value= <?php echo stripslashes($record['phone']); ?>><br>	  
	  <?php xl ('Street Address:','e');?>
	  <input id="address" name="address" type='text' size="45" maxlength="250"	  
      value= "<?php echo stripslashes($record['address']); ?>"><br>
	  <div class='bold'><?php xl('Screening', 'e'); ?></div>
	  <?php xl('Screening Date:', 'e'); ?>
      <input type='text' size='10' class='datepicker' name='screen_date' id='screen_date'
	  value=<?php echo ($record['screen_date']);?>
      title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
	  <?php xl('Screening Location:', 'e'); ?>
	  <input id="screen_loc" name="screen_loc" type='text' size="45" maxlength="250" value= "<?php echo stripslashes ($record['screen_loc']); ?>" /><br>
	  <?php xl('Screening Type:', 'e'); ?>
	  <input type='text' id="screen_type" name="screen_type" list="screen_types" value= "<?php echo stripslashes ($record['screen_type']); ?>" /><br>		  
	  <datalist id = "screen_types"/>
        <option value = "" ></option>		
        <option value = "ASQ" >ASQ</option>
        <option value = "ASQ-SE">ASQ-SE</option>
        <option value = "MCHAT">MCHAT</option>
		<option value = "Other">Other</option>
      </datalist>
	  <?php xl('Screening Outcome:', 'e'); ?><br>
        <input type="radio" name="screen_outcome" id="screen_outcome" value = "normal" <?php if ($record["screen_outcome"] == 'normal') { echo "CHECKED"; } ?> >Within normal limits</option><br>
        <input type="radio" name="screen_outcome" id="screen_outcome" value = "monitoring" <?php if ($record["screen_outcome"] == 'monitoring') { echo "CHECKED"; } ?> >In monitoring zone</option><br>
        <input type="radio" name="screen_outcome" id="screen_outcome" value = "concerning" <?php if ($record["screen_outcome"] == 'concerning') { echo "CHECKED"; } ?> >Concerning and in need of evaluation</option><br>
	</div>
    <div class="column">
    <input type="hidden" name="serv_offered" id="serv_offered" value="off">	
	<h1><?php xl('Child Family Navigation Services Offered?', 'e'); ?>&nbsp;
	<input type="checkbox" name="serv_offered" id="serv_offered" <?php if ($record["serv_offered"] == "on") {
	echo "checked";
	}?>></input></h1><br>
	<div class='bold'><?php xl('Child Family Navigation Services Provided', 'e'); ?></div>
	<?php xl('Contact Date:', 'e'); ?>	
	<input type='text' size='10' class='datepicker' name='contact_date' id='contact_date'
      value= <?php echo ($record['contact_date']);?>     
	  title='<?php xl('yyyy-mm-dd', 'e'); ?>' /><br>
	<?php xl('Type of Contact:', 'e'); ?>
	<input type='text' id="contact_type" name="contact_type"size="45" maxlength="250" list="contact_types" value= "<?php echo stripslashes ($record['contact_type']); ?>"/><br>	
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
	<textarea name="notes" id="notes" cols="35" rows="6"><?php echo stripslashes ($record['notes']); ?></textarea>
	<div class='bold'><?php xl('Parent/Sibling Navigation Services Provided', 'e'); ?></div>
	<?php xl('Screening Done:', 'e'); ?>
	<input id="fam_screen" name="fam_screen" type='text' size="45" maxlength="250" value= "<?php echo stripslashes ($record['fam_screen']); ?>" /><br>
	<?php xl('Referrals Made:', 'e'); ?>
	<input id="referrals" name="referrals" type='text' size="45" maxlength="250" value= "<?php echo stripslashes ($record['referrals']); ?>" /><br>	
	<?php xl('Notes', 'e'); ?><br>
	<textarea name="fam_notes" id="fam_notes" cols="35" rows="6" ><?php echo stripslashes ($record['fam_notes']); ?></textarea>	
	</div>
  </div>
</div> <!-- end form_container -->

</form>

</body>

<script language="javascript">
window.print();
window.close();
</script>

</html>
