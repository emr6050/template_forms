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
$table_name = "form_redir_questionnaire";

/** CHANGE THIS name to the name of your form **/
$form_name = "REDIRECT Questionnaire";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "questionnaire";

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

<div id="general">
  <span class="bold_underline"><?php xl('Please answer the following questions about your child who is receiving screening today.','e');?></span><br>
  1) <?php xl('What is your relationship to the child or children being screened today?','e');?><br>
    <input type="radio" name="relationship" value="Mother" <?php if ($record["relationship"] == "Mother") {
	echo "checked";
	}?>><?php xl('Mother','e');?> &nbsp;
	<input type="radio" name="relationship" value="Father" <?php if ($record["relationship"] == "Father") {
	echo "checked";
	}?>><?php xl('Father','e');?> &nbsp;
	<input type="radio" name="relationship" value="Grandparent" <?php if ($record["relationship"] == "Grandparent") {
	echo "checked";
	}?>><?php xl('Grandparent','e');?> &nbsp;
	<input type="radio" name="relationship" value="Aunt/Uncle/Cousin" <?php if ($record["relationship"] == "Aunt/Uncle/Cousin") {
	echo "checked";
	}?>><?php xl('Aunt/Uncle/Cousin','e');?>&nbsp; 
	<input type="radio" name="relationship" value="Legal Guardian" <?php if ($record["relationship"] == "Legal Guardian") {
	echo "checked";
	}?>><?php xl('Legal Guardian','e');?><br>			  
	<input type="radio" name="relationship" value="Other" <?php if ($record["relationship"] == "Other") {
	echo "checked";
	}?>><?php xl('Another relationship:','e');?> &nbsp;		  
    <input id="relationshp_other" name="relationshp_other" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['relationshp_other']);?>'><br>
  2) <?php xl('How old is your child who is being screened today?','e');?> &nbsp;
    <input id="child_age" name="child_age" type="text" size="10" maxlength="50" value='<?php echo stripslashes($record['child_age']);?>'> &nbsp;
	<?php xl('years old','e');?><br>
  3) <?php xl('What is the race and ethnicity of your child who is being screened today?','e');?><br>
    <input type="hidden" name="eth_blk" id="eth_blk" value="off"> 
    <input type="checkbox" name="eth_blk" id="eth_blk"<?php if ($record["eth_blk"] == "on") {
	echo "checked";
	}?> /> <?php xl('Black or African American or Caribbean','e');?><br>
    <input type="hidden" name="eth_wht" id="eth_wht" value="off"> 	
    <input type="checkbox" name="eth_wht" <?php if ($record["eth_wht"] == "on") {
	echo "checked";
	}?> /> <?php xl('White','e');?><br>
    <input type="hidden" name="eth_asn" id="eth_asn" value="off"> 	
    <input type="checkbox" name="eth_asn" <?php if ($record["eth_asn"] == "on") {
	echo "checked";
	}?>/><?php xl('Asian','e');?><br>
    <input type="hidden" name="eth_his" id="eth_his" value="off"> 	
    <input type="checkbox" name="eth_his" <?php if ($record["eth_his"] == "on") {
	echo "checked";
	}?>/> <?php xl('Hispanic or Latino','e');?><br>
    <input type="hidden" name="eth_nam" id="eth_nam" value="off"> 	
    <input type="checkbox" name="eth_nam" <?php if ($record["eth_nam"] == "on") {
	echo "checked";
	}?>/> <?php xl('Native American','e');?><br>
    <input type="hidden" name="eth_nis" id="eth_nis" value="off"> 	
    <input type="checkbox" name="eth_nis" <?php if ($record["eth_nis"] == "on") {
	echo "checked";
	}?>/><?php xl('Native Hawaiian or Pacific Islander','e');?><br>
    <input type="hidden" name="eth_other" id="eth_other" value="off"> 	
    <input type="checkbox" name="eth_other" <?php if ($record["eth_other"] == "on") {
	echo "checked";
	}?>/> <?php xl('Other (specify): ','e');?>&nbsp;	
	<input id="ethnicity" name="ethnicity" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['ethnicity']);?>' ><br>
  4) <?php xl('Where does your child or children spend most of their time during the week? ','e');?><br>  
    <input type="radio" name="week_time" value="School" <?php if ($record["week_time"] == "School") {
	echo "checked";
	}?>/><?php xl('School','e');?> <br>
    <input type="radio" name="week_time" value="Daycare Center" <?php if ($record["week_time"] == "Daycare Center") {
	echo "checked";
	}?> /><?php xl('Daycare Center or child care center','e');?> <br>
    <input type="radio" name="week_time" value="Home Daycare" <?php if ($record["week_time"] == "Home Daycare") {
	echo "checked";
	}?> /><?php xl('Home-based daycare ','e');?> <br>
    <input type="radio" name="week_time" value="Home-Guardian" <?php if ($record["week_time"] == "Home-Guardian") {
	echo "checked";
	}?>/><?php xl('At home with a parent or guardian','e');?> <br>
    <input type="radio" name="week_time" value="Home-Relative" <?php if ($record["week_time"] == "Home-Relative") {
	echo "checked";
	}?>/><?php xl('At the home of a grandparent or other relative','e');?> <br> 	
    <input type="radio" name="week_time" value="Other" <?php if ($record["week_time"] == "Other") {
	echo "checked";
	}?>/><?php xl('Another place: ','e');?> 
	<input id="week_other" name="week_other" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['week_other']);?>'><br>  
  5) <?php xl('Does your child have health insurance? ','e');?><br>
    <input type="radio" name="insured" value="No" <?php if ($record["insured"] == "No") {
	echo "checked";
	}?>><?php xl('No – my child does not have health insurance','e');?> <br>
    <input type="radio" name="insured" value="Yes-Badger Care" <?php if ($record["insured"] == "Yes-Badger Care") {
	echo "checked";
	}?>><?php xl('Yes – Badger Care','e');?> <br>
    <input type="radio" name="insured" value="Yes-Medicaid" <?php if ($record["insured"] == "Yes-Medicaid") {
	echo "checked";
	}?>><?php xl('Yes – Medicaid/Forward Card','e');?> <br>
    <input type="radio" name="insured" value="Yes-Employer" <?php if ($record["insured"] == "Yes-Employer") {
	echo "checked";
	}?>><?php xl('Yes – Health insurance through an employer','e');?> <br>
    <input type="radio" name="insured" value="Yes-ACA" <?php if ($record["insured"] == "Yes-ACA") {
	echo "checked";
	}?>><?php xl('Yes – Health insurance through the Affordable Care Act/Obamacare/ Exchange','e');?> <br> 
    <input type="radio" name="insured" value="Yes-Other" <?php if ($record["insured"] == "Yes-Other") {
	echo "checked";
	}?>><?php xl('Yes – Another type of insurance: ','e');?> 
	<input id="ins_other" name="ins_other" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['ins_other']);?>'><br>	
  6) <?php xl('Does your child have a pediatrician or primary care physician? ','e');?><br> 
    <input type="radio" name="primary_care" value="Yes" <?php if ($record["primary_care"] == "Yes") {
	echo "checked";
	}?>><?php xl('Yes','e');?>   
    <input type="radio" name="primary_care" value="No" <?php if ($record["primary_care"] == "No") {
	echo "checked";
	}?>><?php xl('No','e');?> <br>    
  7) <?php xl('In general, how would you describe your child\'s health? ','e');?><br> 
    <input type="radio" name="overall_health" value="Excellent" <?php if ($record["overall_health"] == "Excellent") {
	echo "checked";
	}?>><?php xl('Excellent','e');?> &nbsp;
    <input type="radio" name="overall_health" value="Very good" <?php if ($record["overall_health"] == "Very good") {
	echo "checked";
	}?>><?php xl('Very good','e');?> &nbsp;
    <input type="radio" name="overall_health" value="Good" <?php if ($record["overall_health"] == "Good") {
	echo "checked";
	}?>><?php xl('Good','e');?> &nbsp;
    <input type="radio" name="overall_health" value="Fair" <?php if ($record["overall_health"] == "Fair") {
	echo "checked";
	}?>><?php xl('Fair','e');?> &nbsp;
    <input type="radio" name="overall_health" value="Poor" <?php if ($record["overall_health"] == "Poor") {
	echo "checked";
	}?>><?php xl('Poor','e');?> <br> 
  8) <?php xl('Has your child had a developmental screening before? ','e');?><br>
    <input type="radio" name="screened" value="Yes" <?php if ($record["screened"] == "Yes") {
	echo "checked";
	}?>><?php xl('Yes','e');?>   
    <input type="radio" name="screened" value="No" <?php if ($record["screened"] == "No") {
	echo "checked";
	}?>><?php xl('No','e');?> <br>    
  9) <?php xl('Has someone suggested you get a developmental screening before? ','e');?><br>
    <input type="hidden" name="screen_no" id="screen_no" value="off">  
    <input type="checkbox" name="screen_no" <?php if ($record["screen_no"] == "on") {
	echo "checked";
	}?>/> <?php xl('No','e');?><br>
    <input type="hidden" name="screen_doc" id="screen_doc" value="off"> 	
    <input type="checkbox" name="screen_doc"<?php if ($record["screen_doc"] == "on") {
	echo "checked";
	}?>/> <?php xl('Yes- A doctor, pediatrician, or health care provider','e');?><br>
    <input type="hidden" name="screen_teach" id="screen_teach" value="off"> 	
    <input type="checkbox" name="screen_teach" <?php if ($record["screen_teach"] == "on") {
	echo "checked";
	}?>/> <?php xl('Yes- A teacher or day care provider','e');?><br>
    <input type="hidden" name="screen_fam" id="screen_fam" value="off"> 	
    <input type="checkbox" name="screen_fam" <?php if ($record["screen_fam"] == "on") {
	echo "checked";
	}?>/> <?php xl('Yes- Another family member or friend','e');?><br>
    <input type="hidden" name="screen_other" id="screen_other" value="off"> 	
    <input type="checkbox" name="screen_other" <?php if ($record["screen_other"] == "on") {
	echo "checked";
	}?>/> <?php xl('Yes – another person:','e');?>&nbsp;
	<input id="screen_note" name="screen_note" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['screen_note']);?>'><br>
  10) <?php xl('Please check any programs or services your child has participated in before: ','e');?><br> 
    <input type="hidden" name="serv_birth" id="serv_birth" value="off"> 
    <input type="checkbox" name="serv_birth" <?php if ($record["serv_birth"] == "on") {
	echo "checked";
	}?>/> <?php xl('Birth to Three','e');?><br>
    <input type="hidden" name="serv_occ" id="serv_occ" value="off"> 	
    <input type="checkbox" name="serv_occ"<?php if ($record["serv_occ"] == "on") {
	echo "checked";
	}?>/> <?php xl('Occupational Therapy','e');?><br>
    <input type="hidden" name="serv_phys" id="serv_phys" value="off"> 	
    <input type="checkbox" name="serv_phys" <?php if ($record["serv_phys"] == "on") {
	echo "checked";
	}?>/> <?php xl('Physical Therapy','e');?><br>
    <input type="hidden" name="serv_speech" id="serv_speech" value="off"> 	
    <input type="checkbox" name="serv_speech" <?php if ($record["serv_speech"] == "on") {
	echo "checked";
	}?>/> <?php xl('Speech Therapy','e');?><br>
    <input type="hidden" name="serv_head" id="serv_head" value="off"> 	
    <input type="checkbox" name="serv_head" <?php if ($record["serv_head"] == "on") {
	echo "checked";
	}?>/> <?php xl('Head Start','e');?><br>
    <input type="hidden" name="serv_mental" id="serv_mental" value="off"> 	
    <input type="checkbox" name="serv_mental" <?php if ($record["serv_mental"] == "on") {
	echo "checked";
	}?>/> <?php xl('Mental health services or treatment','e');?><br>
    <input type="hidden" name="serv_special" id="serv_special" value="off"> 	
    <input type="checkbox" name="serv_special" <?php if ($record["serv_special"] == "on") {
	echo "checked";
	}?>/> <?php xl('Special education','e');?><br>
    <input type="hidden" name="serv_home" id="serv_home" value="off"> 	
    <input type="checkbox" name="serv_home" <?php if ($record["serv_home"] == "on") {
	echo "checked";
	}?>/> <?php xl('Another service or program in your home:','e');?>
	<input id="serv_home_note" name="serv_home_note" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['serv_home_note']);?>'><br>
    <input type="hidden" name="serv_other" id="serv_other" value="off"> 	
    <input type="checkbox" name="serv_other" <?php if ($record["serv_other"] == "on") {
	echo "checked";
	}?>/></input> <?php xl('Another service or program outside of your home: ','e');?>
	<input id="serv_other_note" name="serv_other_note" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['serv_other_note']);?>'><br>  		
  <span class="bold_underline"><?php xl('Please answer the following questions about you and your family.','e');?></span><br>
  11) <?php xl('What zip code do you currently live in?','e');?>
    <input id="zip_code" name="zip_code" type="text" size="10" maxlength="50" value='<?php echo stripslashes($record['zip_code']);?>'><br>
  12) <?php xl('What is your gender?','e');?><br>
    <input type="radio" name="adult_gender" value="Male" <?php if ($record["adult_gender"] == "Male") {
	echo "checked";
	}?>><?php xl('Male','e');?> <br>  
    <input type="radio" name="adult_gender" value="Female" <?php if ($record["adult_gender"] == "Female") {
	echo "checked";
	}?>><?php xl('Female','e');?> <br>  	
    <input type="radio" name="adult_gender" value="Other" <?php if ($record["adult_gender"] == "Other") {
	echo "checked";
	}?>><?php xl('Another Gender:','e');?> &nbsp
    <input id="gender_note" name="gender_note" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['gender_note']);?>'><br>	
  13) <?php xl('How old are you?','e');?>&nbsp;
    <input id="adult_age" name="adult_age" type="text" size="10" maxlength="50" value='<?php echo stripslashes($record['adult_age']);?>'> &nbsp;
	<?php xl('years old','e');?><br>  
  14) <?php xl('What is your race/ethnicity?','e');?><?php xl('choose all that apply','e');?><br>
    <input type="hidden" name="ad_eth_blk" id="ad_eth_blk" value="off">  
    <input type="checkbox" name="ad_eth_blk" <?php if ($record["ad_eth_blk"] == "on") {
	echo "checked";
	}?>/> <?php xl('Black or African American or Caribbean','e');?><br>
    <input type="hidden" name="ad_eth_wht" id="ad_eth_wht" value="off"> 	
    <input type="checkbox" name="ad_eth_wht" <?php if ($record["ad_eth_wht"] == "on") {
	echo "checked";
	}?>/> <?php xl('White','e');?><br>
    <input type="hidden" name="ad_eth_asn" id="ad_eth_asn" value="off"> 	
    <input type="checkbox" name="ad_eth_asn" <?php if ($record["ad_eth_asn"] == "on") {
	echo "checked";
	}?>/> <?php xl('Asian','e');?><br>
    <input type="hidden" name="ad_eth_his" id="ad_eth_his" value="off"> 	
    <input type="checkbox" name="ad_eth_his" <?php if ($record["ad_eth_his"] == "on") {
	echo "checked";
	}?>/> <?php xl('Hispanic or Latino','e');?><br>
    <input type="hidden" name="ad_eth_nam" id="ad_eth_nam" value="off"> 	
    <input type="checkbox" name="ad_eth_nam" <?php if ($record["ad_eth_nam"] == "on") {
	echo "checked";
	}?>/> <?php xl('Native American','e');?><br>
    <input type="hidden" name="ad_eth_nis" id="ad_eth_nis" value="off"> 	
    <input type="checkbox" name="ad_eth_nis" <?php if ($record["ad_eth_nis"] == "on") {
	echo "checked";
	}?>/> <?php xl('Native Hawaiian or Pacific Islander','e');?><br>
    <input type="hidden" name="ad_eth_other" id="ad_eth_other" value="off"> 	
    <input type="checkbox" name="ad_eth_other" <?php if ($record["ad_eth_other"] == "on") {
	echo "checked";
	}?>/> <?php xl('Other (specify): ','e');?>&nbsp;	
	<input id="ad_ethnicity" name="ad_ethnicity" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['ad_ethnicity']);?>'><br> 
  15) <?php xl('What is your relationship status?','e');?><br>
    <input type="radio" name="rel_status" value="Married" <?php if ($record["rel_status"] == "Married") {
	echo "checked";
	}?>><?php xl('Married','e');?> &nbsp;
    <input type="radio" name="rel_status" value="Living together" <?php if ($record["rel_status"] == "Living together") {
	echo "checked";
	}?>><?php xl('Living together (like married)','e');?> &nbsp;
    <input type="radio" name="rel_status" value="Partner" <?php if ($record["rel_status"] == "Partner") {
	echo "checked";
	}?>><?php xl('Boyfriend/girlfriend/partner','e');?> <br>
    <input type="radio" name="rel_status" value="Divorced" <?php if ($record["rel_status"] == "Divorced") {
	echo "checked";
	}?>><?php xl('Divorced','e');?> &nbsp;  
    <input type="radio" name="rel_status" value="Widowed" <?php if ($record["rel_status"] == "Widowed") {
	echo "checked";
	}?>><?php xl('Widowed','e');?> &nbsp;  	
    <input type="radio" name="rel_status" value="Single" <?php if ($record["rel_status"] == "Single") {
	echo "checked";
	}?>><?php xl('Single','e');?> <br>  
  16) <?php xl('What is your current work situation?','e');?><br>
    <input type="radio" name="work_status" value="Work full time" <?php if ($record["work_status"] == "Work full time") {
	echo "checked";
	}?>><?php xl('Work full time','e');?> <br> 
    <input type="radio" name="work_status" value="Regular part-time" <?php if ($record["work_status"] == "Regular part-time") {
	echo "checked";
	}?>><?php xl('Regular part-time','e');?> <br> 
    <input type="radio" name="work_status" value="Occasional part-time" <?php if ($record["work_status"] == "Occasional part-time") {
	echo "checked";
	}?>><?php xl('Occasional part-time','e');?> <br> 
    <input type="radio" name="work_status" value="Not currently working" <?php if ($record["work_status"] == "Not currently working") {
	echo "checked";
	}?>><?php xl('Not currently working','e');?> <br>      
  17) <?php xl('What is the highest grade you completed in school?','e');?><br>
    <input type="radio" name="education" value="Grade 8 or less" <?php if ($record["education"] == "Grade 8 or less") {
	echo "checked";
	}?>><?php xl('8th grage or less','e');?> <br> 
    <input type="radio" name="education" value="Grade 8-12" <?php if ($record["education"] == "Grade 8-12") {
	echo "checked";
	}?>><?php xl('more than 8th grade but less than 12th grade','e');?> <br> 
    <input type="radio" name="education" value="High School or GED" <?php if ($record["education"] == "High School or GED") {
	echo "checked";
	}?>><?php xl('I graduated from high school or received a GED','e');?> <br> 
    <input type="radio" name="education" value="Some college" <?php if ($record["education"] == "Some college") {
	echo "checked";
	}?>><?php xl('I started college','e');?> <br>   
    <input type="radio" name="education" value="College graduate" <?php if ($record["education"] == "College graduate") {
	echo "checked";
	}?>><?php xl('I graduated from college','e');?><br> 
  18) <?php xl('What was your personal income last year?','e');?><br>   
    <input type="radio" name="income" value="Less than $10,000" <?php if ($record["income"] == "Less than $10,000") {
	echo "checked";
	}?>><?php xl('Less than $10,000','e');?> &nbsp;
    <input type="radio" name="income" value="$10,001-$20,000" <?php if ($record["income"] == "$10,001-$20,000") {
	echo "checked";
	}?>><?php xl('$10,001-$20,000','e');?> &nbsp;
    <input type="radio" name="income" value="$20,001-$30,000" <?php if ($record["income"] == "20,001-$30,000") {
	echo "checked";
	}?>><?php xl('$20,001-$30,000','e');?> &nbsp;
    <input type="radio" name="income" value="$30,001-$40,000" <?php if ($record["income"] == "$30,001-$40,000") {
	echo "checked";
	}?>><?php xl('$30,001-$40,000','e');?> &nbsp;  
    <input type="radio" name="income" value="Over $40,000" <?php if ($record["income"] == "Over $40,000") {
	echo "checked";
	}?>><?php xl('Over $40,000','e');?> <br>  	
  19) <?php xl('During the past month, how hard has it been to pay for the very basics like food, housing, medical care, and heating? ','e');?><br>  
    <input type="radio" name="basic_costs"  value="Not hard at all" <?php if ($record["basic_costs"] == "Not hard at all") {
	echo "checked";
	}?>> <?php xl('Not hard at all','e');?> &nbsp;
    <input type="radio" name="basic_costs"  value="Somewhat hard" <?php if ($record["basic_costs"] == "Somewhat hard") {
	echo "checked";
	}?>><?php xl('Somewhat hard','e');?> &nbsp;
    <input type="radio" name="basic_costs"  value="Very hard" <?php if ($record["basic_costs"] == "Very hard") {
	echo "checked";
	}?>><?php xl('Very hard','e');?> &nbsp;
    <input type="radio" name="basic_costs"  value="Don't know" <?php if ($record["basic_costs"] == "Don't know") {
	echo "checked";
	}?>><?php xl('Don\'t know','e');?> <br>	
 <span class="bold_underline"><?php xl('These last questions are about the support you have from your friends and community. ','e');?></span><br>
  20) <?php xl('I know who to call and where to go in the community when I need help.have relationships with people who provide me with support when I need it.','e');?><br> 
    <input type="radio" name="support" value="Strongly agree" <?php if ($record["support"] == "Strongly agree") {
	echo "checked";
	}?>><?php xl('Strongly agree','e');?> &nbsp;
    <input type="radio" name="support" value="Agree" <?php if ($record["support"] == "Agree") {
	echo "checked";
	}?>><?php xl('Agree','e');?> &nbsp;
    <input type="radio" name="support" value="Not sure" <?php if ($record["support"] == "Not sure") {
	echo "checked";
	}?>><?php xl('Not sure','e');?> &nbsp;
    <input type="radio" name="support" value="Disagree" <?php if ($record["support"] == "Disagree") {
	echo "checked";
	}?>><?php xl('Disagree','e');?> &nbsp;
    <input type="radio" name="support" value="Strongly disagree" <?php if ($record["support"] == "Strongly disagree") {
	echo "checked";
	}?>><?php xl('Strongly disagree','e');?> <br> 
  21) <?php xl('I feel satisfied with the resources in my community (e.g., library, parks, playgrounds, etc.).','e');?><br>  
    <input type="radio" name="comm_call" value="Strongly agree" <?php if ($record["comm_call"] == "Strongly agree") {
	echo "checked";
	}?>><?php xl('Strongly agree','e');?> &nbsp;
    <input type="radio" name="comm_call" value="Agree" <?php if ($record["comm_call"] == "Agree") {
	echo "checked";
	}?>><?php xl('Agree','e');?> &nbsp;
    <input type="radio" name="comm_call" value="Not sure" <?php if ($record["comm_call"] == "Not sure") {
	echo "checked";
	}?>><?php xl('Not sure','e');?> &nbsp;
    <input type="radio" name="comm_call" value="Disagree" <?php if ($record["comm_call"] == "Disagree") {
	echo "checked";
	}?>><?php xl('Disagree','e');?> &nbsp;
    <input type="radio" name="comm_call" value="Strongly disagree" <?php if ($record["comm_call"] == "Strongly disagree") {
	echo "checked";
	}?>><?php xl('Strongly disagree','e');?> <br> 
  22) <?php xl('I have relationships with people who provide me with support when I need it.','e');?><br> 
    <input type="radio" name="comm_res" value="Strongly agree" <?php if ($record["comm_res"] == "Strongly agree") {
	echo "checked";
	}?>><?php xl('Strongly agree','e');?> &nbsp;
    <input type="radio" name="comm_res" value="Agree" <?php if ($record["comm_res"] == "Agree") {
	echo "checked";
	}?>><?php xl('Agree','e');?> &nbsp;
    <input type="radio" name="comm_res" value="Not sure" <?php if ($record["comm_res"] == "Not sure") {
	echo "checked";
	}?>><?php xl('Not sure','e');?> &nbsp;
    <input type="radio" name="comm_res" value="Disagree" <?php if ($record["comm_res"] == "Disagree") {
	echo "checked";
	}?>><?php xl('Disagree','e');?> &nbsp;
    <input type="radio" name="comm_res" value="Strongly disagree" <?php if ($record["comm_res"] == "Strongly disagree") {
	echo "checked";
	}?>><?php xl('Strongly disagree','e');?> <br>  
  23) <?php xl('I feel good about my ability to parent and take care of my children.','e');?><br>
    <input type="radio" name="parent_abil" value="Strongly agree" <?php if ($record["parent_abil"] == "Strongly agree") {
	echo "checked";
	}?>><?php xl('Strongly agree','e');?> &nbsp;
    <input type="radio" name="parent_abil" value="Agree" <?php if ($record["parent_abil"] == "Agree") {
	echo "checked";
	}?>><?php xl('Agree','e');?> &nbsp;
    <input type="radio" name="parent_abil" value="Not sure" <?php if ($record["parent_abil"] == "Not sure") {
	echo "checked";
	}?>><?php xl('Not sure','e');?> &nbsp;
    <input type="radio" name="parent_abil" value="Disagree" <?php if ($record["parent_abil"] == "Disagree") {
	echo "checked";
	}?>><?php xl('Disagree','e');?> &nbsp;
    <input type="radio" name="parent_abil" value="Strongly disagree" <?php if ($record["parent_abil"] == "Strongly disagree") {
	echo "checked";
	}?>><?php xl('Strongly disagree','e');?> <br>
  24) <?php xl('I know how to seek help from the agencies in my community to get things that my family needs.','e');?><br> 
    <input type="radio" name="agencies" value="Strongly agree" <?php if ($record["agencies"] == "Strongly agree") {
	echo "checked";
	}?>><?php xl('Strongly agree','e');?> &nbsp;
    <input type="radio" name="agencies" value="Agree" <?php if ($record["agencies"] == "Agree") {
	echo "checked";
	}?>><?php xl('Agree','e');?> &nbsp;
    <input type="radio" name="agencies" value="Not sure" <?php if ($record["agencies"] == "Not sure") {
	echo "checked";
	}?>><?php xl('Not sure','e');?> &nbsp;
    <input type="radio" name="agencies" value="Disagree" <?php if ($record["agencies"] == "Disagree") {
	echo "checked";
	}?>><?php xl('Disagree','e');?> &nbsp;
    <input type="radio" name="agencies" value="Strongly disagree" <?php if ($record["agencies"] == "Strongly disagree") {
	echo "checked";
	}?>><?php xl('Strongly disagree','e');?> <br>	
  25) <?php xl('I have people to talk to when I am worried about my children or parenting.','e');?><br>  
    <input type="radio" name="parent_talk" value="Strongly agree" <?php if ($record["parent_talk"] == "Strongly agree") {
	echo "checked";
	}?>><?php xl('Strongly agree','e');?> &nbsp;
    <input type="radio" name="parent_talk" value="Agree" <?php if ($record["parent_talk"] == "Agree") {
	echo "checked";
	}?>><?php xl('Agree','e');?> &nbsp;
    <input type="radio" name="parent_talk" value="Not sure"<?php if ($record["parent_talk"] == "Not sure") {
	echo "checked";
	}?>><?php xl('Not sure','e');?> &nbsp;
    <input type="radio" name="parent_talk" value="Disagree" <?php if ($record["parent_talk"] == "Disagree") {
	echo "checked";
	}?>><?php xl('Disagree','e');?> &nbsp;
    <input type="radio" name="parent_talk" value="Strongly disagree" <?php if ($record["parent_talk"] == "Strongly disagree") {
	echo "checked";
	}?>><?php xl('Strongly disagree','e');?> <br>
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
