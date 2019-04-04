<?php if ( ! defined('WEDDING_API_DIR')) { exit; } ?>

<?php WeddingPlannerView::get_header(); ?>

<header class="header--bar">
	<div class="container">
		<h1 class="header--title">Melding huwelijk of geregistreerd partnerschap</h1>
	</div>
</header>
<div class="container page--holder">
    <div class="container--pages">
		<?php
			// <div class="form-group">
			// 	<!-- Toggle button -->
			// 	<button class="mdc-icon-button" aria-label="Add to favorites" aria-pressed="false" data-mdc-auto-init="MDCIconButtonToggle">
			// 		<i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">A</i>
			// 		<i class="material-icons mdc-icon-button__icon">B</i>
			// 	</button>
			// </div>

			// <div class="form-group">
			// 	<!-- Normal button -->
			// 	<button class="mdc-button">Learn More</button>
			// </div>

			// <div class="form-group">
		 //    	<!-- Switch button -->
			// 	<div class="mdc-switch" data-mdc-auto-init="MDCSwitch">
			// 		<div class="mdc-switch__track"></div>
			// 		<div class="mdc-switch__thumb-underlay">
			// 			<div class="mdc-switch__thumb">
			// 				<input type="checkbox" id="basic-switch" class="mdc-switch__native-control" role="switch">
			// 			</div>
			// 		</div>
			// 	</div>
			// 	<label for="basic-switch">off/on</label>
			// </div>
		?>

        <!-- First page -->
        <section class="section--page active" data-page="1">

        	<div class="page-intro">
        		<p>Hieronder ziet u onze ambtenaren en trouwlocaties. Door te klikken op een naam uit de lijst kunt u meer informatie bekijken. Alles wat u hier kiest zal bij uw aanvraag al ingevuld zijn.</p>
				<p>U kunt maximaal 12 maanden in de toekomst plannen.</p>
        	</div>

        	<div id="horizontalTab">
				<ul>
					<li><a href="#locations-tab"><i class="fas fa-home"></i> Locatie</a></li>
					<li><a href="#functionary-tab"><i class="fas fa-user-tie"></i> Ambtenaar</a></li>
					<li><a href="#availability-tab"><i class="fas fa-calendar-alt"></i> Beschikbaarheid</a></li>
				</ul>

				<div id="locations-tab">
					
					<select name="prep_location">
						<?php foreach ($locations_list as $key => $value) { ?>
							<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
						<?php } ?>
					</select>

				</div>

				<div id="functionary-tab">
					
					<select name="prep_functionary">
						<?php foreach ($functionaries_list as $key => $value) { ?>
							<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
						<?php } ?>
					</select>
				</div>

				<div id="availability-tab">
					<div id="availability-calendar"></div>

					<div class="table-responsive wepl_table--container">
						<table class="table wepl_table">
							<tbody>
								<tr class="wepl_table--timeslots">
									<td></td>
									<td>
										<strong>09:00</strong>
										<strong>10:30</strong>
									</td>
									<td>
										<strong>10:30</strong>
										<strong>11:00</strong>
									</td>
									<td>
										<strong>11:00</strong>
										<strong>12:30</strong>
									</td>
								</tr>
								<tr class="wepl_table--head">
									<th>Locaties</th>
									<td colspan="3"></td>
								</tr>
								<?php foreach ($locations_list as $key => $value) { ?>
									<tr class="wepl_table--options">
										<th><?php echo $value; ?></th>
										<td class="blocked"></td>
										<td class="selected--col"></td>
										<td></td>
									</tr>
								<?php } ?>
								<!-- <tr class="wepl_table--options">
									<th>Locatie 2</th>
									<td class="blocked"></td>
									<td class="selected--col"></td>
									<td></td>
								</tr>
								<tr class="wepl_table--options">
									<th>Locatie 3</th>
									<td></td>
									<td class="selected--col"></td>
									<td></td>
								</tr> -->
								<tr class="wepl_table--head">
									<th>Ambtenaren</th>
									<td colspan="3"></td>
								</tr>
								<?php foreach ($functionaries_list as $key => $value) { ?>
									<tr class="wepl_table--options">
										<th><?php echo $value; ?></th>
										<td></td>
										<td class="selected--col"></td>
										<td></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
			
			<hr>
			<a href="#" class="btn btn-default btn-lg btn-block goto--page" data-goto="2"><i class="fas fa-play"></i> Start aanvraag</a>

        </section>

        <!-- Second page -->
        <section class="section--page" data-page="2">
        	Klaar om te starten met de aanvraag!
        </section>

    </div>
</div>

<?php WeddingPlannerView::get_footer(); ?>