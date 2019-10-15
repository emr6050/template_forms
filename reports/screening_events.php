<?php
/**
 * This report lists patients that were seen within a given date
 * range, or all patients if no date range is entered.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2006-2016 Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2017 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../globals.php");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

use OpenEMR\Core\Header;

// Prepare a string for CSV export.
function qescape($str)
{
    $str = str_replace('\\', '\\\\', $str);
    return str_replace('"', '\\"', $str);
}

$from_date = DateToYYYYMMDD($_POST['form_from_date']);
$to_date   = DateToYYYYMMDD($_POST['form_to_date']);
if (empty($to_date) && !empty($from_date)) {
    $to_date = date('Y-12-31');
}

if (empty($from_date) && !empty($to_date)) {
    $from_date = date('Y-01-01');
}

$form_provider = empty($_POST['form_provider']) ? 0 : intval($_POST['form_provider']);

// In the case of CSV export only, a download will be forced.
if ($_POST['form_csvexport']) {
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Disposition: attachment; filename=screen_event_rep.csv");
    header("Content-Description: File Transfer");
} else {
?>
<html>
<head>

<title><?php echo xlt('REDIRECT Screening Events'); ?></title>

<?php Header::setupHeader(['datetime-picker', 'report-helper']); ?>

<script language="JavaScript">

$(document).ready(function() {
    oeFixedHeaderSetup(document.getElementById('mymaintable'));
    top.printLogSetup(document.getElementById('printbutton'));

    $('.datepicker').datetimepicker({
        <?php $datetimepicker_timepicker = false; ?>
        <?php $datetimepicker_showseconds = false; ?>
        <?php $datetimepicker_formatInput = true; ?>
        <?php require($GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php'); ?>
        <?php // can add any additional javascript settings to datetimepicker here; need to prepend first setting with a comma ?>
    });
});

</script>

<style type="text/css">

/* specifically include & exclude from printing */
@media print {
    #report_parameters {
        visibility: hidden;
        display: none;
    }
    #report_parameters_daterange {
        visibility: visible;
        display: inline;
        margin-bottom: 10px;
    }
    #report_results table {
       margin-top: 0px;
    }
}

/* specifically exclude some from the screen */
@media screen {
    #report_parameters_daterange {
        visibility: hidden;
        display: none;
    }
    #report_results {
        width: 100%;
    }
}

</style>

</head>

<body class="body_top">

<!-- Required for the popup date selectors -->
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>

<span class='title'><?php echo xlt('Report'); ?> - <?php echo xlt('REDIRECT Screening Events'); ?></span>

<div id="report_parameters_daterange">
<?php if (!(empty($to_date) && empty($from_date))) { ?>
    <?php echo text(oeFormatShortDate($from_date)) ." &nbsp; " . xlt('to') . " &nbsp; " . text(oeFormatShortDate($to_date)); ?>
<?php } ?>
</div>

<form name='theform' id='theform' method='post' action='screening_events.php' onsubmit='return top.restoreSession()'>

<div id="report_parameters">

<input type='hidden' name='form_refresh' id='form_refresh' value=''/>
<input type='hidden' name='form_csvexport' id='form_csvexport' value=''/>

<table>
 <tr>
  <td width='60%'>
    <div style='float:left'>

    <table class='text'>
        <tr>
            <td class='control-label'>
                <?php echo xlt('Encounter Date From'); ?>:
            </td>
            <td>
               <input class='datepicker form-control' type='text' name='form_from_date' id="form_from_date" size='10' value='<?php echo attr(oeFormatShortDate($from_date)); ?>'>
            </td>
            <td class='control-label'>
                <?php echo xlt('To'); ?>:
            </td>
            <td>
               <input class='datepicker form-control' type='text' name='form_to_date' id="form_to_date" size='10' value='<?php echo attr(oeFormatShortDate($to_date)); ?>'>
            </td>
        </tr>
    </table>

    </div>

  </td>
  <td align='left' valign='middle' height="100%">
    <table style='border-left:1px solid; width:100%; height:100%' >
        <tr>
            <td>
        <div class="text-center">
                  <div class="btn-group" role="group">
                    <a href='#' class='btn btn-default btn-save' onclick='$("#form_csvexport").val(""); $("#form_refresh").attr("value","true"); $("#theform").submit();'>
                        <?php echo xlt('Submit'); ?>
                    </a>
                    <a href='#' class='btn btn-default btn-transmit' onclick='$("#form_csvexport").attr("value","true"); $("#theform").submit();'>
                        <?php echo xlt('Export to CSV'); ?>
                    </a>
                    <?php if ($_POST['form_refresh']) { ?>
                      <a href='#' id='printbutton' class='btn btn-default btn-print'>
                            <?php echo xlt('Print'); ?>
                      </a>
                    <?php } ?>
              </div>
        </div>
            </td>
        </tr>
    </table>
  </td>
 </tr>
</table>
</div> <!-- end of parameters -->

<?php
} // end not form_csvexport

if ($_POST['form_refresh'] || $_POST['form_csvexport']) {
    if ($_POST['form_csvexport']) {
        // CSV headers:
        echo '"' . xl('First') . '",';
        echo '"' . xl('Last') . '",';
        echo '"' . xl('Middle') . '",';
        echo '"' . xl('Screening Date') . '",';
        echo '"' . xl('Location of Event') . '",';
        echo '"' . xl('Family Navigation Services Offered') . '",';
        echo '"' . xl('Referrals Provided') . '",';
        echo '"' . xl('Screen Outcome') . '"' . "\n";
    } else {
    ?>

  <div id="report_results">
  <table id='mymaintable'>
   <thead>
    <th> <?php echo xlt('Child\'s Name'); ?> </th>
    <th> <?php echo xlt('Screening Date'); ?> </th>
    <th> <?php echo xlt('Location of Event'); ?> </th>
    <th> <?php echo xlt('Family Navigation Services Offered'); ?> </th>
    <th> <?php echo xlt('Referrals Provided'); ?> </th>
    <th> <?php echo xlt('Screen Outcome'); ?> </th>
 </thead>
 <tbody>
<?php
    } // end not export
    $totalpts = 0;
	$concerning=0;
	$per_concerning="";
	$fam_nav_offered=0;
	$referrals=0;
    $sqlArrayBind = array();
    $query = "SELECT " .
    "p.fname, p.mname, p.lname, p.street, p.city, p.state, " .
    "p.postal_code,  p.phone_biz, p.pid, p.pubpid, " .
    "count(e.date) AS ecount, max(e.date) AS edate, " .
    "i1.date AS idate1, i2.date AS idate2, " .
    "c1.name AS cname1, c2.name AS cname2," .
	"f.date As fdate1,f.pid, f.screen_outcome,f.screen_date, ".
	"f.screen_loc,f.serv_offered,f.referrals ".
    "FROM patient_data AS p ";
    if (!empty($from_date)) {
        $query .= "JOIN form_encounter AS e ON " .
        "e.pid = p.pid AND " .
        "e.date >= ? AND " .
        "e.date <= ? ";
        array_push($sqlArrayBind, $from_date .' 00:00:00', $to_date . ' 23:59:59');
        if ($form_provider) {
            $query .= "AND e.provider_id = ? ";
            array_push($sqlArrayBind, $form_provider);
        }
    } else {
        if ($form_provider) {
            $query .= "JOIN form_encounter AS e ON " .
            "e.pid = p.pid AND e.provider_id = ? ";
            array_push($sqlArrayBind, $form_provider);
        } else {
            $query .= "LEFT OUTER JOIN form_encounter AS e ON " .
            "e.pid = p.pid ";
        }
    }

    $query .=
    "LEFT OUTER JOIN insurance_data AS i1 ON " .
    "i1.pid = p.pid AND i1.type = 'primary' " .
    "LEFT OUTER JOIN insurance_companies AS c1 ON " .
    "c1.id = i1.provider " .
    "LEFT OUTER JOIN insurance_data AS i2 ON " .
    "i2.pid = p.pid AND i2.type = 'secondary' " .
    "LEFT OUTER JOIN insurance_companies AS c2 ON " .
    "c2.id = i2.provider " .
	"JOIN form_fam_nav AS f ON ".
	"f.pid = p.pid ".
	"".
    "GROUP BY p.lname, p.fname, p.mname, p.pid, i1.date, i2.date " .
    "ORDER BY p.lname, p.fname, p.mname, p.pid, i1.date DESC, i2.date DESC";
    $res = sqlStatement($query, $sqlArrayBind);

    $prevpid = 0;
    while ($row = sqlFetchArray($res)) {
        if ($row['pid'] == $prevpid) {
            continue;
        }

        $prevpid = $row['pid'];
        $age = '';
        if ($row['DOB']) {
            $dob = $row['DOB'];
            $tdy = $row['edate'] ? $row['edate'] : date('Y-m-d');
            $ageInMonths = (substr($tdy, 0, 4)*12) + substr($tdy, 5, 2) -
                   (substr($dob, 0, 4)*12) - substr($dob, 5, 2);
            $dayDiff = substr($tdy, 8, 2) - substr($dob, 8, 2);
            if ($dayDiff < 0) {
                --$ageInMonths;
            }

            $age = intval($ageInMonths/12);
        }
        if ($row['screen_date'] != "") {
            $dateparts = explode(" ", $row['screen_date']);
            $row['screen_date'] = $dateparts[0];
        }
        if ($_POST['form_csvexport']) {
            echo '"' . qescape($row['lname']) . '",';
            echo '"' . qescape($row['fname']) . '",';
            echo '"' . qescape($row['mname']) . '",';
            echo '"' . qescape($row['screen_date']) . '",';
            echo '"' . qescape($row['screen_loc']) . '",';
            echo '"' . qescape($row['serv_offered']) . '",';
            echo '"' . qescape($row['referrals']) . '",';
            echo '"' . qescape($row['screen_outcome']) . '"' . "\n";
        } else {
        ?>
       <tr>

   <td>
        <?php echo text($row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname']); ?>
   </td>
   <td>
        <?php echo text($row['screen_date']); ?>
   </td>
   <td>
        <?php echo text($row['screen_loc']); ?>
   </td>
   <td>
        <?php echo text($row['serv_offered']); ?>
   </td>
   <td>
        <?php echo text($row['referrals']); ?>
   </td>
   <td>
        <?php echo text($row['screen_outcome']); ?>
   </td>
  </tr>
    <?php
        } // end not export
        ++$totalpts;
		if (text($row['screen_outcome'])=="concerning"){
		++$concerning;	
		}
		if (text($row['serv_offered'])=="on"){
		++$fam_nav_offered;	
		}
		if (!text($row['referrals'])==""){
		++$referrals;	
		}
		if (!totalpts==0){
		$per_concerning=($concerning/$totalpts)*100;	
		}		
    } // end while
    if (!$_POST['form_csvexport']) {
    ?>


   <tr class="report_totals">
    <td colspan='9'>
        <?php echo xlt('Number of Children Screened: '); ?>
        <?php echo text($totalpts); ?><br>
        <?php echo xlt('Number of Children with Concerning Screens: '); ?>
        <?php echo text($concerning); ?><br>
        <?php echo xlt('Percentage of Children who had Concerning Screens: '); ?>
        <?php echo text($per_concerning); ?>
		<?php echo xlt('%'); ?><br>
        <?php echo xlt('Number of Children offered Family Navigation Services: '); ?>
        <?php echo text($fam_nav_offered); ?><br>
        <?php echo xlt('Number of Children offered Referrals: '); ?>
        <?php echo text($referrals); ?><br>			
  </td>
 </tr>

</tbody>
</table>
</div> <!-- end of results -->
<?php
    } // end not export
} // end if refresh or export

if (!$_POST['form_refresh'] && !$_POST['form_csvexport']) {
?>
<div class='text'>
    <?php echo xlt('Please input search criteria above, and click Submit to view results.'); ?>
</div>
<?php
}

if (!$_POST['form_csvexport']) {
?>

</form>
</body>

</html>
<?php
} // end not export
?>
