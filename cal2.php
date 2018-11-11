<?Php
// Joni arumugam / 11/11/18 
//

$start_year=2000; 
$end_year=2020;  
?>
<html>
<head>
	<script langauge="javascript">
	function post_value(mm,dt,yy){
			opener.document.f1.p_name.value = mm + "/" + dt + "/" + yy;
			self.close();
	}

	function reload(form){
			var month_val=document.getElementById('month').value; // collect month value
			var year_val=document.getElementById('year').value;      // collect year value
			self.location='cal2.php?month=' + month_val + '&year=' + year_val ; // reload the page
	}
	</script>

	<style type="text/css">
		table.main { width: 30%; border: 1px solid black;	 }
		table.main td { font-family: verdana,arial, helvetica,  sans-serif; font-size: 11px; }
		table.main th { border-width: 1px 1px 1px 1px; 	padding: 0px 0px 0px 0px;   }
		table.main a{TEXT-DECORATION: none;}
		table,td{ border: 1px solid  }
		table.main th{ background-color: red; }
	</style>
</head>


<body>
<?Php
@$month=$_GET['month'];
@$year=$_GET['year'];
if(!($month <13 and $month >0)){ $month =date("m");  }
if(!($year <=$end_year and $year >=$start_year)){ $year =date("Y");  }
$d= 2; 
$no_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$j= date('w',mktime(0,0,0,$month,1,$year)); 
$adj=str_repeat("<td >*&nbsp;</td>",$j);  
$blank_at_end=42-$j-$no_of_days; 
if($blank_at_end >= 7){$blank_at_end = $blank_at_end - 7 ;} 
$adj2=str_repeat("<td >*&nbsp;</td>",$blank_at_end); 
echo "<center><table class='main' border='1' ><td colspan=7 bgcolor='#003333'> <center> <select name=month onchange=\"reload(this.form)\" id=\"month\"> ";
for($p=1;$p<=12;$p++)
{
	$dateObject   = DateTime::createFromFormat('!m', $p);
	$monthName = $dateObject->format('F');
	if($month==$p){ echo "<option value=$p selected>$monthName</option>"; }else{
	echo "<option value=$p>$monthName</option>";
	}
}
echo "</select>
<select name=year onchange=\"reload(this.form)\" id=\"year\">Select Year</option>";
for($i=$start_year;$i<=$end_year;$i++){
	if($year==$i){ echo "<option value='$i' selected>$i</option>"; }else{ echo "<option value='$i'>$i</option>"; }
}
echo "</select>";
echo " </center> </td></tr><tr>";
echo "<th>S</th><th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th></tr><tr>";

for($i=1;$i<=$no_of_days;$i++)
{
	$pv="'$month'".","."'$i'".","."'$year'";
	echo $adj."<td><a href='#' onclick=\"post_value($pv);\">$i</a>"; 
	echo " </td>";
	$adj='';
	$j ++;
	if($j==7){echo "</tr><tr>"; $j=0;}
}
echo $adj2;   
echo "</tr></table></center>";
?>
</body>
</html>
