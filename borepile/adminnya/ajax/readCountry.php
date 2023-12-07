<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM data_komplain WHERE petugas like '" . $_POST["keyword"] . "%' ORDER BY petugas LIMIT 0,6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectCountry('<?php echo $country["petugas"]; ?>');"><?php echo $country["petugas"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>