<?php
// Start the session
require_once 'classes/Member.php';
require_once 'session_config.php';
?>

<!-- CSS stylesheet -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link
	href='https://fonts.googleapis.com/css?family=Lato:400,300,600,700,800'
	rel='stylesheet' type='text/css'>
<!-- JavaScript files -->
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="js/si.js" type="text/javascript"></script>
<!-- JavaScript for dropdown menu -->
<script>
$(document).ready(function() {
	$('li').hover(function() {
		$(this).find('ul>li').stop().fadeToggle(400);
	});
});
</script>
</head>

<body>
	<div class="header">

		<div class="header_logo">
			<div class="logo float-lt">
				<!-- logo immage -->
				<a href="index.php"><img src="images/social_investor_logo_new.png"
					alt="" /></a>
			</div>
			<div class="float-rt">

				<!-- If there is a member in the session, the login button will disappear and be replaced with the member's name  -->
				<?php
				
				$memberIsLoggedIn = isset ( $_SESSION ['loggedInMember'] );
				
				if ($memberIsLoggedIn) {
					echo '<div class="header_button_div"><strong>' . $_SESSION ['loggedInMember']->fName . '</strong> you\'re logged in</div>';
					echo '<div class="header_button_div"><a href="login.php" class="button">Logout</a></div>';
				} else {
					echo '<div class="header_button_div"><a href="register.php" class="button">Sign up!</a></div>';
					echo '<div class="header_button_div"><a href="login.php" class="button">Login</a></div>';
				}
				?>
				
				
				

			</div>
		</div>
		<div class="clear"></div>
		<div class="header_menu">
			<div class="h_menu4">
				<!-- global naviation -->
				<ul class="nav">
					<li><a href="#">Goals</a>
						<ul>
							<li><a href="financial_goal_categories.php">View goals</a></li>
							<?php
							if ($memberIsLoggedIn) {
								echo "<li><a href=\"goal_category_results.php?category=myGoals\">My goals</a></li>";
							}
							?>
						</ul></li>
					<li><a href="#">Start a Goal</a>
						<ul>
							<li><a href="#">Learn more</a></li>
							<?php
							if ($memberIsLoggedIn) {
								echo "<li><a href=\"start_goal_1.php\">Create a goal</a></li>";
							}
							?>
						</ul></li>
					<li><a href="#">About Us</a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="page_wrap_1024">