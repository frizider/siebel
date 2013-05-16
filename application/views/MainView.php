<div class="row">
	
	<div class="span12">
		
		<?= form_open('/', array('class' => 'subnav')); ?>
			
			<ul class="nav nav-pills">
				
				<li class="dropdown span1 first">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-star-empty"></i> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="dropdown">
							<a href="#">Reset</a>
							<a href="#">Status 2</a>
							<a href="#">Status 3</a>
							<a href="#">...</a>
						</li>
					</ul>
				</li>

				<li class="span3">
					<input name="search_profile" class="span2" placeholder="Profiel...">
				</li>

				<li class="dropdown span3">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Afwerking <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="dropdown">
							<a href="#">Reset</a>
							<a href="#">Eindverpakking brut</a>
							<a href="#">Eindverpakking anod</a>
							<a href="#">...</a>
						</li>
					</ul>
				</li>
				
				<li class="span3">
					<input name="search_customer" class="span2" placeholder="Klant...">
				</li>

				<li class="dropdown">
					<div class="btn btn-small btn-primary search"><i class="icon-search icon-white"></i> Zoeken</div>
					<div data-href="#" class="btn btn-small create"><i class="icon-pencil"></i> Maken</div>
				</li>

				
			</ul>
			
		</form>
	
	</div> <!-- End span12 -->
	
</div> <!-- end row -->

<div class="container list list-striped">

<?php foreach($lists as $list) { ?>
	<div class="row">
		<div class="span12">
				<div class="span1 first">
					<?= $list->state ?> <br />
				</div>
				<div class="span3">
					<b><?= $list->profile ?></b> <br/>
					<small><?= $list->customerreference ?></small>
				</div>
				<div class="span3">
					<b><?= $list->finish ?></b> <br/>
					<small><?= $list->length ?></small>
				</div>
				<div class="span3">
					<b>Klantnaam</b> <br/>
					<small><?= $list->customernumber ?></small>
				</div>
				<div class="span2">
					<br />
				</div>
			</div>
	</div>
			
<?php } ?>
</div>

