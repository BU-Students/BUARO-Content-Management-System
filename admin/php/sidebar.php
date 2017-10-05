<nav id="sidebar">
	<ul class="nav sidebar-nav">
		<!--<li class="sidebar-item"><a href="dashboard.php"><span class="glyphicon glyphicon-tasks"></span>Dashboard</a></li>-->
		<?php
			//if parent admin
			if($_SESSION["admin-type"] == 1) {
				echo(
				'<li class="sidebar-item" id="admins-tab"><a href="administrators.php"><span class="glyphicon glyphicon-user"></span>Administrators</a></li>'
				);
			}
		?>
		<li class="sidebar-item" id="story-event-tab"><a href="eventstory.php"><span class="glyphicon glyphicon-book"></span>Stories and Events</a></li>
		<li class="sidebar-item" id="eshop-tab"><a href="eshop.php"><span class="glyphicon glyphicon-shopping-cart"></span>E-Shop</a></li>	
		<?php
			//if parent admin
			if($_SESSION["admin-type"] != 1) {
				echo('<li class="sidebar-item" id="unit-college-tab"><a href="unit_college.php"><span class="glyphicon glyphicon-calendar"></span>Your College</a></li>');
			}
			else {
				echo(
				'<li class="sidebar-item" id="donation-tab"><a href="donate.php"><span class="glyphicon glyphicon-folder-open"></span>Donation Projects</a></li>'.
				'<li class="sidebar-item" id="contact-tab"><a href="contact.php"><span class="glyphicon glyphicon-phone"></span>Contact Us</a></li>'.
				'<li class="sidebar-item" id="about-tab"><a href="about.php"><span class="glyphicon glyphicon-info-sign"></span>About Us</a></li>'.
				'<li class="sidebar-item" id="feedback-tab"><a href="feedback.php"><span class="glyphicon glyphicon-comment"></span>Feedbacks</a></li>'
				);
			}
		
		?>
	</ul>
</nav>