<?php 
echo form_open(current_url(), $form_attributes);
$state = $contacts[0]->RESTATE;

if($state == 1) 
{
?>
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="empty-state">
				<div class="empty-img"></div>
				<div class="empty-txt">
					<h3><?php echo $this->siebel->getLang('empty_heading_newcontacts', $lang); ?></h3>
					<p><?php echo $this->siebel->getLang('empty_text_newcontacts', $lang); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}
else 
{

	echo $this->bootstrap->heading(1, $this->siebel->getLang('enter_newcontacts', $lang), '<a data-step="1" data-intro="'.$this->siebel->getLang('intro_help', $lang).'" data-position="left" class="btn" href="javascript:void(0);" onclick="javascript:introJs().start();"><i class="icon-question-sign"></i></a>'); 
	echo '<div id="contacts">';

	foreach($contacts as $contact)
	{
?>


	<div class="row">
		<div class="span12 contactlist">
			<a href="#" class="remove"><i class="icon-remove icon-white"></i></a>
			<?php 
			echo form_hidden('contact1[RECUID]', $customerId);
			echo form_hidden('contact1[RECUNO]', $customerNo);
			?>

			<div class="well">
				<div class="row" data-step="2" data-intro="<?php echo $this->siebel->getLang('intro_newcontact_firstcontact', $lang) ?>">
					<div class="span3">
						<label><?php echo ucfirst($this->siebel->getLang('name', $lang)) ?></label>
						<?php echo form_input('contact1[RENAM1]', trim($contact->RENAM1)) ?>
					</div>

					<div class="span3">
						<label><?php echo ucfirst($this->siebel->getLang('email', $lang)) ?></label>
						<?php echo form_input('contact1[REEMAIL]', trim($contact->REEMAIL)) ?>
					</div>

					<div class="span3">
						<label><?php echo ucfirst($this->siebel->getLang('phone', $lang)) ?></label>
						<?php echo form_input('contact1[REPHONE]', trim($contact->REPHONE)) ?>
					</div>

					<div class="span2">
						<label><?php echo ucfirst($this->siebel->getLang('fax', $lang)) ?></label>
						<?php echo form_input('contact1[REFAX]', trim($contact->REFAX)) ?>
					</div>
				</div>
				<hr/>
				<div class="row" data-step="3" data-intro="<?php echo $this->siebel->getLang('intro_newcontact_departements', $lang) ?>">
					<?php
					$departments = $this->siebel->getDepartments($lang);
					foreach($departments as $key => $value)
					{
						$retgen = ($key == 'RETGEN') ? 1 : 0;
						$check = ($key == 'RETGEN') ? 'checked' : '';
						$check_icon = ($key == 'RETGEN') ? 'icon-ok' : '';
						echo '<div class="span2"><input type="hidden" name="contact1['.$key.']" value="'.$retgen.'" id="'.$key.'1" class="'.$key.'"><label class="checkbox pull-left '.$check.'" data-name="'.$key.'1" data-value="1"><a href="#" class="checkbox-wrapper"><span class="cb-inner"><i class="'.$check_icon.' icon-white"></i></span></a>'.ucfirst($value).'</label></div>';
					}
					?>
				</div>
			</div>

		</div>
	</div>

<?php 
echo '</div>';

	} // End foreach
?>

<div class="row">
	<div class="span12">
		<div class="form-actions">
			<div class="pull-left">
				<a href="#" data-step="4" data-intro="<?php echo $this->siebel->getLang('intro_newcontact_addcontact', $lang) ?>" data-position="top" class="btn btn-primary add-contact" data-value="2" data-number="<?php echo trim($customerNo) ?>" data-id="<?php echo trim($customerId) ?>"><?php echo ucfirst($this->siebel->getLang('add_extra_contact', $lang)) ?></a>
			</div>
			<div class="pull-right">
				<button  data-step="5" data-intro="<?php echo $this->siebel->getLang('intro_newcontact_finish', $lang) ?>" data-position="top" type="submit" class="btn btn-success"><?php echo ucfirst($this->siebel->getLang('send', $lang)) ?></button>
				<button class="btn btn-danger">Cancel</button>
			</div>
		</div>
	</div>
</div>

<?php 
	echo form_close(); 
} // end if/else state
?>

<script type="text/javascript">
	
	$(document).ready(function() {
		setTimeout(function(){ 
			introJs().start();
		}, 2000 ); 
		
		$('a.add-contact').click(function(e) {
			e.preventDefault();
			var i = $(this).attr('data-value');
			var cuid = $(this).attr('data-id');
			var cuno = $(this).attr('data-number');
			$(this).attr('data-value', parseInt(i)+1);
			
			var container = '<div class="row">'
					+'<div class="span12 contactlist">'
						+'<a href="#" class="remove"><i class="icon-remove icon-white"></i></a>'
						+'<input type="hidden" name="contact'+i+'[RECUID]" value="'+cuid+'" />'
						+'<input type="hidden" name="contact'+i+'[RECUNO]" value="'+cuno+'" />'
						+'<div class="well">'
							+'<div class="row">'
								+'<div class="span3">'
									+'<label><?php echo ucfirst($this->siebel->getLang('name', $lang)) ?></label>'
									+'<input type="text" name="contact'+i+'[RENAM1]" />'
								+'</div>'

								+'<div class="span3">'
									+'<label><?php echo ucfirst($this->siebel->getLang('email', $lang)) ?></label>'
									+'<input type="text" name="contact'+i+'[REEMAIL]" />'
								+'</div>'

								+'<div class="span3">'
									+'<label><?php echo ucfirst($this->siebel->getLang('phone', $lang)) ?></label>'
									+'<input type="text" name="contact'+i+'[REPHONE]" />'
								+'</div>'

								+'<div class="span2">'
									+'<label><?php echo ucfirst($this->siebel->getLang('fax', $lang)) ?></label>'
									+'<input type="text" name="contact'+i+'[REFAX]" />'
								+'</div>'
							+'</div>'
							+'<hr/>'
							+'<div class="row">'
								<?php
								$departments = $this->siebel->getDepartments($lang);
								foreach($departments as $key => $value)
								{
										echo '+\'<div class="span2"><input type="hidden" name="contact\'+i+\'['.$key.']" value="0" id="'.$key.'\'+i+\'" class="'.$key.'"><label class="checkbox pull-left " data-name="'.$key.'\'+i+\'" data-value="1"><a href="#" class="checkbox-wrapper"><span class="cb-inner"><i class=" icon-white"></i></span></a>'.ucfirst($value).'</label></div>\'';
								}
								?>
							+'</div>'
						+'</div>'
					+'</div>'
				+'</div>';
			$('#contacts').append(container);
		});
		
		$(document).delegate('a.remove', 'click', function(e) {
			e.preventDefault();
			$(this).parent().remove();
		});
		
	});
	
</script>
