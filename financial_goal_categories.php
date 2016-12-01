<?php
// Header script
require_once "header.php";
$msg = 'Explore investment goals and personalise them to your needs';
?>
<!DOCTYPE HTML>
<html>
<!-- Page Header  -->
<head>
<title>Social Investor - Financial Goal Categories</title>
<div class="subtitle">
	<span class="left_line1"> </span>Choose a goal<span class="right_line1"></span>
</div>
<p class="preamble_message"><?php echo $msg; ?></p>
<!--  create new class - not form container -->

<!-- Need to put links in for content -->
<div class="category_container">
	<div class="category_type_container float-lt">
		<div class="category_col">
			<a href="goal_category_results.php?category=Car"><img src="images/car.png" alt=""></a>
		</div>
		<div class="clear"></div>
		<div class="category_name txt-center">Car</div>
	</div>
	<div class="category_type_container float-lt">
		<div class="category_col">
			<a href="goal_category_results.php?category=Children"><img src="images/child.png" alt=""></a>
		</div>
		<div class="clear"></div>
		<div class="category_name txt-center">Children</div>
	</div>
	<div class="category_type_container float-lt">
		<div class="category_col">
			<a href="goal_category_results.php?category=Education"><img src="images/education.png" alt=""></a>
		</div>
		<div class="clear"></div>
		<div class="category_name txt-center">Education</div>
	</div>
	<div class="category_type_container float-lt">
		<div class="category_col">
			<a href="goal_category_results.php?category=Emergencies"><img src="images/emergency.jpg" alt=""></a>
		</div>
		<div class="clear"></div>
		<div class="category_name txt-center">Emergencies</div>
	</div>
	<div class="category_type_container float-lt">
		<div class="category_col">
			<a href="goal_category_results.php?category=Debt"><img src="images/debt.png" alt=""></a>
		</div>
		<div class="clear"></div>
		<div class="category_name txt-center">Debt</div>
	</div>
	<div class="clear"></div>
	<div class="category_type_container float-lt">
		<div class="category_col">
			<a href="goal_category_results.php?category=Holiday"><img src="images/holiday.png" alt=""></a>
		</div>
		<div class="clear"></div>
		<div class="category_name txt-center">Holiday</div>
	</div>
	<div class="category_type_container float-lt">
		<div class="category_col">
			<a href="goal_category_results.php?category=House"><img src="images/house.png" alt=""></a>
		</div>
		<div class="clear"></div>
		<div class="category_name txt-center">House</div>
	</div>
	<div class="category_type_container float-lt">
		<div class="category_col">
			<a href="goal_category_results.php?category=Pets"><img src="images/pets.png" alt=""></a>
		</div>
		<div class="clear"></div>
		<div class="category_name txt-center">Pets</div>
	</div>
	<div class="category_type_container float-lt">
		<div class="category_col">
			<a href="goal_category_results.php?category=Retirement"><img src="images/pension.png" alt=""></a>
		</div>
		<div class="clear"></div>
		<div class="category_name txt-center">Retirement</div>
	</div>
	<div class="category_type_container float-lt">
		<div class="category_col">
			<a href="goal_category_results.php?category=Wedding"><img src="images/wedding.png" alt=""></a>
		</div>
		<div class="clear"></div>
		<div class="category_name txt-center">Wedding</div>
	</div>
</div>
<?php require_once "footer.php"; ?>