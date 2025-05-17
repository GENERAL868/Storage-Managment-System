<?php
// function to display errors in a form
function DisplayErrors() {
    global $errors;
    echo "<form>\n";
    echo "<h3 style='color:red;'>Could Not Save or process data.</h3><p>\n";
    echo "The following errors <b>found</b> in data inputs\n";
	echo "<ol>";
	foreach($errors as $k=>$v){
		echo "<li><mark>$v</mark></li>\n";
	}
	echo "</ol>\n";
    echo "<a href=javascript:history.back()>Click here to correct these errors</a><br>\n";
    echo "</form>\n";
}
?>