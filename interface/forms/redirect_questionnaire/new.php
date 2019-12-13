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
$form_name = "REDIRECT Questionnaire";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "redirect_questionnaire";

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

<?php $res = sqlStatement("SELECT fname,mname,lname,ss,street,city,state,postal_code,phone_home,DOB FROM patient_data WHERE pid = $pid");
$result = SqlFetchArray($res); ?>

<!-- container for the main body of the form -->
<div id="form_container">

<div id="general">
  <span class="bold_underline"><?php xl('Please answer the following questions about your child who is receiving screening today.','e');?></span><br>
  1) <?php xl('What is your relationship to the child or children being screened today?','e');?><br>
    <input type="radio" name="relationship" value="Mother" /><?php xl('Mother','e');?> &nbsp;
	<input type="radio" name="relationship" value="Father" /><?php xl('Father','e');?> &nbsp;
	<input type="radio" name="relationship" value="Grandparent" /><?php xl('Grandparent','e');?> &nbsp;
	<input type="radio" name="relationship" value="Aunt/Uncle/Cousin" /><?php xl('Aunt/Uncle/Cousin','e');?>&nbsp; 
	<input type="radio" name="relationship" value="Legal Guardian" /><?php xl('Legal Guardian','e');?><br>			  
	<input type="radio" name="relationship" value="Other" /><?php xl('Another relationship:','e');?> &nbsp;		  
    <input id="relationshp_other" name="relationshp_other" type="text" size="50" maxlength="250"><br>
  2) <?php xl('How old is your child who is being screened today?','e');?> &nbsp;
    <input id="child_age" name="child_age" type="text" size="10" maxlength="50"> &nbsp;
	<?php xl('years old','e');?><br>
  3) <?php xl('What is the race and ethnicity of your child who is being screened today?','e');?><br>
    <input type="checkbox" name="eth_blk" ></input> <?php xl('Black or African American or Caribbean','e');?><br>
    <input type="checkbox" name="eth_wht" ></input> <?php xl('White','e');?><br>
    <input type="checkbox" name="eth_asn" ></input> <?php xl('Asian','e');?><br>
    <input type="checkbox" name="eth_his" ></input> <?php xl('Hispanic or Latino','e');?><br>
    <input type="checkbox" name="eth_nam" ></input> <?php xl('Native American','e');?><br>
    <input type="checkbox" name="eth_nis" ></input> <?php xl('Native Hawaiian or Pacific Islander','e');?><br>
    <input type="checkbox" name="eth_other" ></input> <?php xl('Other (specify): ','e');?>&nbsp;	
	<input id="ethnicity" name="ethnicity" type="text" size="50" maxlength="250"><br>
  4) <?php xl('Where does your child or children spend most of their time during the week? ','e');?><br>  
    <input type="radio" name="week_time" value="School" /><?php xl('School','e');?> <br>
    <input type="radio" name="week_time" value="Daycare Center" /><?php xl('Daycare Center or child care center','e');?> <br>
    <input type="radio" name="week_time" value="Home Daycare" /><?php xl('Home-based daycare ','e');?> <br>
    <input type="radio" name="week_time" value="Home-Guardian" /><?php xl('At home with a parent or guardian','e');?> <br>
    <input type="radio" name="week_time" value="Home-Relative" /><?php xl('At the home of a grandparent or other relative','e');?> <br> 	
    <input type="radio" name="week_time" value="Other" /><?php xl('Another place: ','e');?> 
	<input id="week_other" name="week_other" type="text" size="50" maxlength="250"><br>  
  5) <?php xl('Does your child have health insurance? ','e');?><br>
    <input type="radio" name="insured" value="No" /><?php xl('No – my child does not have health insurance','e');?> <br>
    <input type="radio" name="insured" value="Yes-Badger Care" /><?php xl('Yes – Badger Care','e');?> <br>
    <input type="radio" name="insured" value="Yes-Medicaid" /><?php xl('Yes – Medicaid/Forward Card','e');?> <br>
    <input type="radio" name="insured" value="Yes-Employer" /><?php xl('Yes – Health insurance through an employer','e');?> <br>
    <input type="radio" name="insured" value="Yes-ACA" /><?php xl('Yes – Health insurance through the Affordable Care Act/Obamacare/ Exchange','e');?> <br> 
    <input type="radio" name="insured" value="Yes-Other" /><?php xl('Yes – Another type of insurance: ','e');?> 
	<input id="ins_other" name="ins_other" type="text" size="50" maxlength="250"><br>	
  6) <?php xl('Does your child have a pediatrician or primary care physician? ','e');?><br> 
    <input type="radio" name="primary_care" value="Yes" /><?php xl('Yes','e');?>   
    <input type="radio" name="primary_care" value="No" /><?php xl('No','e');?> <br>    
  7) <?php xl('In general, how would you describe your child\'s health? ','e');?><br> 
    <input type="radio" name="overall_health" value="Excellent" /><?php xl('Excellent','e');?> &nbsp;
    <input type="radio" name="overall_health" value="Very good" /><?php xl('Very good','e');?> &nbsp;
    <input type="radio" name="overall_health" value="Good" /><?php xl('Good','e');?> &nbsp;
    <input type="radio" name="overall_health" value="Fair" /><?php xl('Fair','e');?> &nbsp;
    <input type="radio" name="overall_health" value="Poor" /><?php xl('Poor','e');?> <br> 
  8) <?php xl('Has your child had a developmental screening before? ','e');?><br>
    <input type="radio" name="screened" value="Yes" /><?php xl('Yes','e');?>   
    <input type="radio" name="screened" value="No" /><?php xl('No','e');?> <br>    
  9) <?php xl('Has someone suggested you get a developmental screening before? ','e');?><br> 
    <input type="checkbox" name="screen_no" ></input> <?php xl('No','e');?><br>
    <input type="checkbox" name="screen_doc" ></input> <?php xl('Yes- A doctor, pediatrician, or health care provider','e');?><br>
    <input type="checkbox" name="screen_teach" ></input> <?php xl('Yes- A teacher or day care provider','e');?><br>
    <input type="checkbox" name="screen_fam" ></input> <?php xl('Yes- Another family member or friend','e');?><br>
    <input type="checkbox" name="screen_other" ></input> <?php xl('Yes – another person:','e');?>&nbsp;
	<input id="screen_note" name="screen_note" type="text" size="50" maxlength="250"><br>
  10) <?php xl('Please check any programs or services your child has participated in before: ','e');?><br> 
    <input type="checkbox" name="serv_birth" ></input> <?php xl('Birth to Three','e');?><br>  
    <input type="checkbox" name="serv_occ" ></input> <?php xl('Occupational Therapy','e');?><br> 
    <input type="checkbox" name="serv_phys" ></input> <?php xl('Physical Therapy','e');?><br>  
    <input type="checkbox" name="serv_speech" ></input> <?php xl('Speech Therapy','e');?><br> 	
    <input type="checkbox" name="serv_head" ></input> <?php xl('Head Start','e');?><br>  
    <input type="checkbox" name="serv_mental" ></input> <?php xl('Mental health services or treatment','e');?><br> 	
    <input type="checkbox" name="serv_special" ></input> <?php xl('Special education','e');?><br>  
    <input type="checkbox" name="serv_home" ></input> <?php xl('Another service or program in your home:','e');?>
	<input id="serv_home_note" name="serv_home_note" type="text" size="50" maxlength="250"><br>	
    <input type="checkbox" name="serv_other" ></input> <?php xl('Another service or program outside of your home: ','e');?>
	<input id="serv_other_note" name="serv_other_note" type="text" size="50" maxlength="250"><br>  		
  <span class="bold_underline"><?php xl('Please answer the following questions about you and your family.','e');?></span><br>
  11) <?php xl('What zip code do you currently live in?','e');?>
    <input id="zip_code" name="zip_code" type="text" size="10" maxlength="50"><br>
  12) <?php xl('What is your gender?','e');?><br>
    <input type="radio" name="adult_gender" value="Male" /><?php xl('Male','e');?> <br>  
    <input type="radio" name="adult_gender" value="Female" /><?php xl('Female','e');?> <br>  	
    <input type="radio" name="adult_gender" value="Other" /><?php xl('Another Gender:','e');?> &nbsp
    <input id="gender_note" name="gender_note" type="text" size="50" maxlength="250"><br>	
  13) <?php xl('How old are you?','e');?>&nbsp;
    <input id="adult_age" name="adult_age" type="text" size="10" maxlength="50"> &nbsp;
	<?php xl('years old','e');?><br>  
  14) <?php xl('What is your race/ethnicity?','e');?><?php xl('choose all that apply','e');?><br> 
    <input type="checkbox" name="ad_eth_blk" ></input> <?php xl('Black or African American or Caribbean','e');?><br>
    <input type="checkbox" name="ad_eth_wht" ></input> <?php xl('White','e');?><br>
    <input type="checkbox" name="ad_eth_asn" ></input> <?php xl('Asian','e');?><br>
    <input type="checkbox" name="ad_eth_his" ></input> <?php xl('Hispanic or Latino','e');?><br>
    <input type="checkbox" name="ad_eth_nam" ></input> <?php xl('Native American','e');?><br>
    <input type="checkbox" name="ad_eth_nis" ></input> <?php xl('Native Hawaiian or Pacific Islander','e');?><br>
    <input type="checkbox" name="ad_eth_other" ></input> <?php xl('Other (specify): ','e');?>&nbsp;	
	<input id="ad_ethnicity" name="ad_ethnicity" type="text" size="50" maxlength="250"><br> 
  15) <?php xl('What is your relationship status?','e');?><br>
    <input type="radio" name="rel_status" value="Married" /><?php xl('Married','e');?> &nbsp;
    <input type="radio" name="rel_status" value="Living together" /><?php xl('Living together (like married)','e');?> &nbsp;
    <input type="radio" name="rel_status" value="Partner" /><?php xl('Boyfriend/girlfriend/partner','e');?> <br>
    <input type="radio" name="rel_status" value="Divorced" /><?php xl('Divorced','e');?> &nbsp;  
    <input type="radio" name="rel_status" value="Widowed" /><?php xl('Widowed','e');?> &nbsp;  	
    <input type="radio" name="rel_status" value="Single" /><?php xl('Single','e');?> <br>  
  16) <?php xl('What is your current work situation?','e');?><br>
    <input type="radio" name="work_status" value="Work full time" /><?php xl('Work full time','e');?> <br> 
    <input type="radio" name="work_status" value="Regular part-time" /><?php xl('Regular part-time','e');?> <br> 
    <input type="radio" name="work_status" value="Occasional part-time" /><?php xl('Occasional part-time','e');?> <br> 
    <input type="radio" name="work_status" value="Not currently working" /><?php xl('Not currently working','e');?> <br>      
  17) <?php xl('What is the highest grade you completed in school?','e');?><br>
    <input type="radio" name="education" value="Grade 8 or less" /><?php xl('8th grage or less','e');?> <br> 
    <input type="radio" name="education" value="Grade 8-12" /><?php xl('more than 8th grade but less than 12th grade','e');?> <br> 
    <input type="radio" name="education" value="High School or GED" /><?php xl('I graduated from high school or received a GED','e');?> <br> 
    <input type="radio" name="education" value="Some college" /><?php xl('I started college','e');?> <br>   
    <input type="radio" name="education" value="College graduate" /><?php xl('I graduated from college','e');?><br> 
  18) <?php xl('What was your personal income last year?','e');?><br>   
    <input type="radio" name="income" value="Less than $10,000" /><?php xl('Less than $10,000','e');?> &nbsp;
    <input type="radio" name="income" value="$10,001-$20,000" /><?php xl('$10,001-$20,000','e');?> &nbsp;
    <input type="radio" name="income" value="$20,001-$30,000" /><?php xl('$20,001-$30,000','e');?> &nbsp;
    <input type="radio" name="income" value="$30,001-$40,000" /><?php xl('$30,001-$40,000','e');?> &nbsp;  
    <input type="radio" name="income" value="Over $40,000" /><?php xl('Over $40,000','e');?> <br>  	
  19) <?php xl('During the past month, how hard has it been to pay for the very basics like food, housing, medical care, and heating? ','e');?><br>  
    <input type="radio" name="basic_costs"  value="Not hard at all"/><?php xl('Not hard at all','e');?> &nbsp;
    <input type="radio" name="basic_costs"  value="Somewhat hard"/><?php xl('Somewhat hard','e');?> &nbsp;
    <input type="radio" name="basic_costs"  value="Very hard"/><?php xl('Very hard','e');?> &nbsp;
    <input type="radio" name="basic_costs"  value="Don't know"/><?php xl('Don\'t know','e');?> <br>	
 <span class="bold_underline"><?php xl('These last questions are about the support you have from your friends and community. ','e');?></span><br>
  20) <?php xl('I know who to call and where to go in the community when I need help.have relationships with people who provide me with support when I need it.','e');?><br> 
    <input type="radio" name="support" value="Strongly agree" /><?php xl('Strongly agree','e');?> &nbsp;
    <input type="radio" name="support" value="Agree" /><?php xl('Agree','e');?> &nbsp;
    <input type="radio" name="support" value="Not sure" /><?php xl('Not sure','e');?> &nbsp;
    <input type="radio" name="support" value="Disagree" /><?php xl('Disagree','e');?> &nbsp;
    <input type="radio" name="support" value="Strongly disagree" /><?php xl('Strongly disagree','e');?> <br> 
  21) <?php xl('I feel satisfied with the resources in my community (e.g., library, parks, playgrounds, etc.).','e');?><br>  
    <input type="radio" name="comm_call" value="Strongly agree" /><?php xl('Strongly agree','e');?> &nbsp;
    <input type="radio" name="comm_call" value="Agree" /><?php xl('Agree','e');?> &nbsp;
    <input type="radio" name="comm_call" value="Not sure" /><?php xl('Not sure','e');?> &nbsp;
    <input type="radio" name="comm_call" value="Disagree" /><?php xl('Disagree','e');?> &nbsp;
    <input type="radio" name="comm_call" value="Strongly disagree" /><?php xl('Strongly disagree','e');?> <br> 
  22) <?php xl('I have relationships with people who provide me with support when I need it.','e');?><br> 
    <input type="radio" name="comm_res" value="Strongly agree" /><?php xl('Strongly agree','e');?> &nbsp;
    <input type="radio" name="comm_res" value="Agree" /><?php xl('Agree','e');?> &nbsp;
    <input type="radio" name="comm_res" value="Not sure" /><?php xl('Not sure','e');?> &nbsp;
    <input type="radio" name="comm_res" value="Disagree" /><?php xl('Disagree','e');?> &nbsp;
    <input type="radio" name="comm_res" value="Strongly disagree" /><?php xl('Strongly disagree','e');?> <br>  
  23) <?php xl('I feel good about my ability to parent and take care of my children.','e');?><br>
    <input type="radio" name="parent_abil" value="Strongly agree" /><?php xl('Strongly agree','e');?> &nbsp;
    <input type="radio" name="parent_abil" value="Agree" /><?php xl('Agree','e');?> &nbsp;
    <input type="radio" name="parent_abil" value="Not sure" /><?php xl('Not sure','e');?> &nbsp;
    <input type="radio" name="parent_abil" value="Disagree" /><?php xl('Disagree','e');?> &nbsp;
    <input type="radio" name="parent_abil" value="Strongly disagree" /><?php xl('Strongly disagree','e');?> <br>
  24) <?php xl('I know how to seek help from the agencies in my community to get things that my family needs.','e');?><br> 
    <input type="radio" name="agencies" value="Strongly agree" /><?php xl('Strongly agree','e');?> &nbsp;
    <input type="radio" name="agencies" value="Agree" /><?php xl('Agree','e');?> &nbsp;
    <input type="radio" name="agencies" value="Not sure" /><?php xl('Not sure','e');?> &nbsp;
    <input type="radio" name="agencies" value="Disagree" /><?php xl('Disagree','e');?> &nbsp;
    <input type="radio" name="agencies" value="Strongly disagree" /><?php xl('Strongly disagree','e');?> <br>	
  25) <?php xl('I have people to talk to when I am worried about my children or parenting.','e');?><br>  
    <input type="radio" name="parent_talk" value="Strongly agree" /><?php xl('Strongly agree','e');?> &nbsp;
    <input type="radio" name="parent_talk" value="Agree" /><?php xl('Agree','e');?> &nbsp;
    <input type="radio" name="parent_talk" value="Not sure" /><?php xl('Not sure','e');?> &nbsp;
    <input type="radio" name="parent_talk" value="Disagree" /><?php xl('Disagree','e');?> &nbsp;
    <input type="radio" name="parent_talk" value="Strongly disagree" /><?php xl('Strongly disagree','e');?> <br>
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

