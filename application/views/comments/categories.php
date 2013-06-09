
<?php 
if(isset($id) && !empty($id))
{
echo $this->bootstrap->heading(1, $this->siebel->getLang('edit_category')); 
?>

<div class="row">
	<div class="span12">

		<?php 
		echo form_open(current_url(), $form_attributes);
			echo form_hidden('category_lang_id', $category_lang_id['value']);
			echo form_input(array('name'=>'slug', 'id'=>'slug', 'class'=>'slug', 'type'=>'hidden', 'value'=>$slug['value']));
			?>
			
		<div class="well">
			<div class="row">
				<div class="span6">
					<?php echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('title').' (EN!)', 'title', array('class' => 'control-label')), array($title)); ?>
				</div>
				<div class="span5">
					<?php 
					$slug['class'] = $slug['class'] . ' disabled';
					$slug['disabled'] = 'disabled';
					echo $this->bootstrap->formControlGroup(array('', 'slug', array('class' => 'control-label')), array($slug));
					?>
				</div>
			</div>

			<div class="row">

				<div class="span6">
					<?php 
					// Dropdown for languages
					$label = $this->siebel->getLang('color');
					$name = (isset($color['value']) && !empty($color['value'])) ? ucfirst($this->siebel->getLang($color['value'])) : $this->siebel->getLang('choose');
					$values = array(
						'blue' => $this->siebel->getLang('blue'), 
						'bluedark' => $this->siebel->getLang('bluedark'), 
						'green' => $this->siebel->getLang('green'), 
						'greendark' => $this->siebel->getLang('greendark'), 
						'yellow' => $this->siebel->getLang('yellow'), 
						'pink' => $this->siebel->getLang('pink'), 
						'purple' => $this->siebel->getLang('purple'), 
						'fushia' => $this->siebel->getLang('fushia'), 
						'lila' => $this->siebel->getLang('lila'), 
						'gray' => $this->siebel->getLang('gray'), 
						);
					echo $this->bootstrap->dropdown(FALSE, $label, $name, 'color', $values, FALSE, FALSE, $color['value']);
					?>
				</div>
				<div class="span5">
				</div>
			</div>
			
			<div class="row">
				<div class="span6">
					<?php echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('dutch'), 'category_lang_nl', array('class' => 'control-label')), array($category_lang_nl)); ?>
				</div>
				
				<div class="span5">
					<?php echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('french'), 'category_lang_fr', array('class' => 'control-label')), array($category_lang_fr)); ?>
				</div>
			</div>

			<div class="row">
				<div class="span6">
					<?php echo $this->bootstrap->formControlGroup(array($this->siebel->getLang('german'), 'category_lang_de', array('class' => 'control-label')), array($category_lang_de)); ?>
				</div>
			</div>

		</div>
			
		<div class="row">
			<div class="span12">
				<div class="form-actions">
					<button type="submit" class="btn btn-primary"><?php echo ucfirst($this->siebel->getLang('save')); ?></button>
					<button class="btn">Cancel</button>
				</div>
			</div>
		</div>
		
		</form>
		
	</div>
</div>

<script type="text/javascript">
	$(document).ready( function() {
		
		$('input#title').focusout(function() {
			var str = $(this).val();
			//titlevalue.replace(/[^a-z0-9\s]/gi, '').replace(/[-\s]/g, '_');
			
			var charMap = {
				à:'a', á:'a', â:'a', ä:'a', ã:'a', å:'a', 
				è:'e', é:'e', ê:'e', ë:'e', 
				ì:'i', í:'i', î:'i', ï:'i', 
				ò:'o', ó:'o', ô:'o', õ:'o', ö:'o', 
				ù:'u', ú:'u', û:'u', ü:'u', 
				À:'a', Á:'a', Â:'a', Ä:'a', Ã:'a', Å:'a', 
				È:'e', É:'e', Ê:'e', Ë:'e', 
				Ì:'i', Í:'i', Î:'i', Ï:'i', 
				Ò:'o', Ó:'o', Ô:'o', Ö:'o', Õ:'o', 
				Ù:'u', Ú:'u', Û:'u', Ü:'u', 
				ý:'y', ñ:'n', æ:'ae', ç:'c', ß:'ss', Æ:'ae', Ç:'c', Ñ:'n', Ý:'y', '-':'_'
			};

			var str_array = str.split('');

			for( var i = 0, len = str_array.length; i < len; i++ ) {
				str_array[ i ] = charMap[ str_array[ i ] ] || str_array[ i ];
			}
			str = str_array.join('');
			str = str.split(' ').join('_');
			str = str.toLowerCase();

			$('input#slug').val(str);
		})
		
	})
</script>

<?php
}
else
{
echo $this->bootstrap->heading(1, $this->siebel->getLang('categories'), '<a class="btn" href="'.current_url().'/new"><i class="icon-plus"></i></a>'); 
?>

<div class="container boxes">

	<div class="row">
		<div class="span12">
			<div class="row">
				<?php foreach($categories as $category) { ?>
					<div class="span3 box">
						<div class="inner bg-<?php echo $category->color ?> txt-white">
							<p>
								<b><?php echo ucfirst($this->siebel->getLang('category_'.$category->slug)) ?></b> <br/>
								<a href="<?php echo site_url("comments/categories/".$category->id); ?>" class="btn btn-small edit"><i class="icon-pencil"></i> <?php echo $this->siebel->getLang('edit') ?></a>
							</p>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
			
</div>
<?php } ?>

