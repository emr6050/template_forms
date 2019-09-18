<?php

include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = "form_wisc_v";

/** CHANGE THIS name to the name of your form **/
$form_name = "WISC-V";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "wisc_v_summary";

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
<h1>Summary</h1>
<h2>Sum of Scaled Scores to Composite Score Conversion</h2>
<table id="convertSumOfScaledToComposite" class="display" style="width:100%">
  <thead>
    <tr>
      <th>Scale</th>
      <th>Sum of Scaled Scores</th>
      <th>Composite Score</th>
      <th>Percentile Rank</th>
      <th>Confidence Interval</th>
    <tr>
  </thead>
  <tbody>
    <tr>
      <td align="left">Verbal Comprehension</td>
      <td align="center"><input type="number" name="vci_sumScaledScores" min="0" value="<?php echo stripslashes($record['vci_sumScaledScores']) ?>"></td>
      <td align="center">VCI <input type="number" name="vci_composite" min="0" value="<?php echo stripslashes($record['vci_composite']) ?>"></td>
      <td align="center"><input type="number" name="vci_percentile" min="0" max="100" value="<?php echo stripslashes($record['vci_percentile']) ?>"></td>
      <td align="center"><input type="number" name="vci_confidence" min="90" value="<?php echo stripslashes($record['vci_confidence']) ?>"></td>
    </tr>
    <tr>
      <td align="left">Visual Spatial</td>
      <td align="center"><input type="number" name="vsi_sumScaledScores" min="0" value="<?php echo stripslashes($record['vsi_sumScaledScores']) ?>"></td>
      <td align="center">VSI <input type="number" name="vsi_composite" min="0" value="<?php echo stripslashes($record['vsi_composite']) ?>"></td>
      <td align="center"><input type="number" name="vsi_percentile" min="0" max="100" value="<?php echo stripslashes($record['vsi_percentile']) ?>"></td>
      <td align="center"><input type="number" name="vsi_confidence" min="90" value="<?php echo stripslashes($record['vsi_confidence']) ?>"></td>
    </tr>
    <tr>
      <td align="left">Fluid Reasoning</td>
      <td align="center"><input type="number" name="fri_sumScaledScores" min="0" value="<?php echo stripslashes($record['fri_sumScaledScores']) ?>"></td>
      <td align="center">FRI <input type="number" name="fri_composite" min="0" value="<?php echo stripslashes($record['fri_composite']) ?>"></td>
      <td align="center"><input type="number" name="fri_percentile" min="0" max="100" value="<?php echo stripslashes($record['fri_percentile']) ?>"></td>
      <td align="center"><input type="number" name="fri_confidence" min="90" value="<?php echo stripslashes($record['fri_confidence']) ?>"></td>
    </tr>
    <tr>
      <td align="left">Working Memory</td>
      <td align="center"><input type="number" name="wmi_sumScaledScores" min="0" value="<?php echo stripslashes($record['wmi_sumScaledScores']) ?>"></td>
      <td align="center">WMI <input type="number" name="wmi_composite" min="0" value="<?php echo stripslashes($record['wmi_composite']) ?>"></td>
      <td align="center"><input type="number" name="wmi_percentile" min="0" max="100" value="<?php echo stripslashes($record['wmi_percentile']) ?>"></td>
      <td align="center"><input type="number" name="wmi_confidence" min="90" value="<?php echo stripslashes($record['wmi_confidence']) ?>"></td>
    </tr>
    <tr>
      <td align="left">Processing Speed</td>
      <td align="center"><input type="number" name="psi_sumScaledScores" min="0" value="<?php echo stripslashes($record['psi_sumScaledScores']) ?>"></td>
      <td align="center">PSI <input type="number" name="psi_composite" min="0" value="<?php echo stripslashes($record['psi_composite']) ?>"></td>
      <td align="center"><input type="number" name="psi_percentile" min="0" max="100" value="<?php echo stripslashes($record['psi_percentile']) ?>"></td>
      <td align="center"><input type="number" name="psi_confidence" min="90" value="<?php echo stripslashes($record['psi_confidence']) ?>"></td>
    </tr>
    <tr>
      <td align="left">Full Scale</td>
      <td align="center"><input type="number" name="fsiq_sumScaledScores" min="0" value="<?php echo stripslashes($record['fsiq_sumScaledScores']) ?>"></td>
      <td align="center">FSIQ <input type="number" name="fsiq_composite" min="0" value="<?php echo stripslashes($record['fsiq_composite']) ?>"></td>
      <td align="center"><input type="number" name="fsiq_percentile" min="0" max="100" value="<?php echo stripslashes($record['fsiq_percentile']) ?>"></td>
      <td align="center"><input type="number" name="fsiq_confidence" min="90" value="<?php echo stripslashes($record['fsiq_confidence']) ?>"></td>
    </tr>
  </tbody>
</table>
<br><br>

<h1>Ancillary and Complementary Analysis</h1>
<h2>Sum of Scaled Scores to Index Score Conversion</h2>
<table id="convertSumOfScaledToIndex" class="display" style="width:100%">
  <thead>
    <tr>
      <th>Scale</th>
      <th>Sum of Scaled Scores</th>
      <th>Index Score</th>
      <th>Percentile Rank</th>
      <th>Confidence Interval</th>
    <tr>
  </thead>
  <tbody>
    <tr>
      <td align="left">Quantitative Reasoning</td>
      <td align="center"><input type="number" name="qri_sumScaledScores" min="0" value="<?php echo stripslashes($record['qri_sumScaledScores']) ?>"></td>
      <td align="center">QRI <input type="number" name="qri_composite" min="0" value="<?php echo stripslashes($record['qri_composite']) ?>"></td>
      <td align="center"><input type="number" name="qri_percentile" min="0" max="100" value="<?php echo stripslashes($record['qri_percentile']) ?>"></td>
      <td align="center"><input type="number" name="qri_confidence" min="90" value="<?php echo stripslashes($record['qri_confidence']) ?>"></td>
    </tr>
    <tr>
      <td align="left">Auditory Working Memory</td>
      <td align="center"><input type="number" name="awmi_sumScaledScores" min="0" value="<?php echo stripslashes($record['awmi_sumScaledScores']) ?>"></td>
      <td align="center">AWMI <input type="number" name="awmi_composite" min="0" value="<?php echo stripslashes($record['awmi_composite']) ?>"></td>
      <td align="center"><input type="number" name="awmi_percentile" min="0" max="100" value="<?php echo stripslashes($record['awmi_percentile']) ?>"></td>
      <td align="center"><input type="number" name="awmi_confidence" min="90" value="<?php echo stripslashes($record['awmi_confidence']) ?>"></td>
    </tr>
    <tr>
      <td align="left">Nonverbal</td>
      <td align="center"><input type="number" name="nvi_sumScaledScores" min="0" value="<?php echo stripslashes($record['nvi_sumScaledScores']) ?>"></td>
      <td align="center">NVI <input type="number" name="nvi_composite" min="0" value="<?php echo stripslashes($record['nvi_composite']) ?>"></td>
      <td align="center"><input type="number" name="nvi_percentile" min="0" max="100" value="<?php echo stripslashes($record['nvi_percentile']) ?>"></td>
      <td align="center"><input type="number" name="nvi_confidence" min="90" value="<?php echo stripslashes($record['nvi_confidence']) ?>"></td>
    </tr>
    <tr>
      <td align="left">General Ability</td>
      <td align="center"><input type="number" name="gai_sumScaledScores" min="0" value="<?php echo stripslashes($record['gai_sumScaledScores']) ?>"></td>
      <td align="center">GAI <input type="number" name="gai_composite" min="0" value="<?php echo stripslashes($record['gai_composite']) ?>"></td>
      <td align="center"><input type="number" name="gai_percentile" min="0" max="100" value="<?php echo stripslashes($record['gai_percentile']) ?>"></td>
      <td align="center"><input type="number" name="gai_confidence" min="90" value="<?php echo stripslashes($record['gai_confidence']) ?>"></td>
    </tr>
    <tr>
      <td align="left">Cognitive Proficiency</td>
      <td align="center"><input type="number" name="cpi_sumScaledScores" min="0" value="<?php echo stripslashes($record['cpi_sumScaledScores']) ?>"></td>
      <td align="center">CPI <input type="number" name="cpi_composite" min="0" value="<?php echo stripslashes($record['cpi_composite']) ?>"></td>
      <td align="center"><input type="number" name="cpi_percentile" min="0" max="100" value="<?php echo stripslashes($record['cpi_percentile']) ?>"></td>
      <td align="center"><input type="number" name="cpi_confidence" min="90" value="<?php echo stripslashes($record['cpi_confidence']) ?>"></td>
    </tr>
  </tbody>
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
