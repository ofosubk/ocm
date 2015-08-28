<?php

$C .= "<h1>Outcomes Tracking</h1>\n";

if (strlen($case_row['problem']) != 2)
{
	$C .= "<div>Please assign a Problem Code to this case before recording outcomes.</div>\n";
	//$C .= pikaTempLib::plugin('lsc_problem','problem',$case_row,null,array('onchange=problem_code_lookup(this.value)'));
}

else
{
	$problem_code = $case_row['problem'];	
	$problem_category = substr($case_row['problem'], 0, 1);
	$sql = "SELECT outcome_name, outcome_value FROM
		outcome_definitions LEFT JOIN outcomes USING(outcome_definition_id)
		WHERE (case_id={$case_row['case_id']} OR case_id IS NULL) 
		AND outcome_problem IN ('{$problem_category}X', '{$problem_code}')
		ORDER BY outcome_problem DESC, outcome_order ASC";
	//echo $sql;
	
	$result = mysql_query($sql);
	$C .= "<table class=\"table table-striped\">\n";
	$i = 0;
	
	while ($row = mysql_fetch_assoc($result))
	{
		$C .= "<tr>\n";
		$C .= "<td>{$row['outcome_name']}</td>\n";
		$C .= "<td>
		<label class=\"radio inline\">
		<input type=\"radio\" name=\"optionsRadios{$i}\" id=\"optionsRadios{$i}\" value=\"option1\">
		Yes</label>
		<label class=\"radio inline\">
		<input type=\"radio\" name=\"optionsRadios{$i}\" id=\"optionsRadios{$i}\" value=\"option1\">
		No</label>
		<label class=\"radio inline\">
		<input type=\"radio\" name=\"optionsRadios{$i}\" id=\"optionsRadios{$i}\" value=\"option1\" checked>
		N/A</label>
		</td>\n";
		$C .= "</tr>\n";
		$i++;
	}
	
	$C .= "</table>\n";
	
	$C .= "<table class=\"table table-striped\">\n";
	$C .= "<tr><td colspan=\"2\">If income was an issue, answer these two questions</td></tr>\n";

	$C .= "<tr>\n";
	$C .= "<td>Actual monthly income at the time the case was closed.</td>
	<td><div class=\"input-prepend input-append\">
	<span class=\"add-on\">$</span>
	<input class=\"span2\" id=\"appendedPrependedInput\" type=\"text\">
	</div></td>\n";
	$C .= "</tr>\n";

	$C .= "<tr>\n";
	$C .= "<td>If Legal Aid had not been involved, what would current monthly income be at the time case was closed?</td>
	<td><div class=\"input-prepend input-append\">
	<span class=\"add-on\">$</span>
	<input class=\"span2\" id=\"appendedPrependedInput\" type=\"text\">
	</div></td>\n";
	$C .= "</tr>\n";

	$C .= "</table>\n";
	

	$C .= "<table class=\"table table-striped\">\n";
	$C .= "<tr><td colspan=\"2\">If assets were an issue, answer these two questions</td></tr>\n";

	$C .= "<tr>\n";
	$C .= "<td>Actual value of assets at the time the case was closed.</td>
	<td><div class=\"input-prepend input-append\">
	<span class=\"add-on\">$</span>
	<input class=\"span2\" id=\"appendedPrependedInput\" type=\"text\">
	</div></td>\n";
	$C .= "</tr>\n";

	$C .= "<tr>\n";
	$C .= "<td>If Legal Aid had not been involved, what would the value of assets be at the time case was closed?</td>
	<td><div class=\"input-prepend input-append\">
	<span class=\"add-on\">$</span>
	<input class=\"span2\" id=\"appendedPrependedInput\" type=\"text\">
	</div></td>\n";
	$C .= "</tr>\n";

	$C .= "</table>\n";


	$C .= "<table class=\"table table-striped\">\n";
	$C .= "<tr><td colspan=\"2\">If debt was an issue, answer these two questions</td></tr>\n";

	$C .= "<tr>\n";
	$C .= "<td>Actual value of debt at the time the case was closed.</td>
	<td><div class=\"input-prepend input-append\">
	<span class=\"add-on\">$</span>
	<input class=\"span2\" id=\"appendedPrependedInput\" type=\"text\">
	</div></td>\n";
	$C .= "</tr>\n";

	$C .= "<tr>\n";
	$C .= "<td>If Legal Aid had not been involved, what would the amount of debt be at the time case was closed?</td>
	<td><div class=\"input-prepend input-append\">
	<span class=\"add-on\">$</span>
	<input class=\"span2\" id=\"appendedPrependedInput\" type=\"text\">
	</div></td>\n";
	$C .= "</tr>\n";

	$C .= "</table>\n";
}

?>
