<?php 
echo form_open(current_url(), $form_attributes);
?>

<input type="hidden" name="formula" value="" id="formula" />

<div class="row">
	<div class="span12">
		<div class="well">
			<div class="span6">
				<div class="control-group">
					<label class="control-label" for="formulaname"><?php echo ucfirst($this->siebel->getLang('name')) ?></label>
					<div class="controls">
						<input name="formulaname" type="text" class="" id="formulaname" value="<?php echo $item->formulaname ?>" placeholder="Give me a name...">
					</div>
				</div>
			</div>
			<div class="span5">
				<div class="control-group">
					<label class="control-label" for="customernumber"><?php echo ucfirst($this->siebel->getLang('customer')) ?></label>
					<div class="controls">
						<input name="customernumber" type="text" class="input-small customersearch" id="customernumber" value="<?php echo $item->customernumber ?>" placeholder="">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Fields -->

<div class="row">
	<div class="span12">
		<ul id="draggable">
			<li data-key="value" data-name="someValue" id="valuefield" class="btn"><span>Value</span> <i class="editValue icon-edit"></i></li>
			<li data-key="fix" data-name="someValue" id="fixfield" class="btn"><span>Fix</span> <i class="editValue icon-edit"></i></li>
			<li data-key="lme" data-name="date" id="lmefield" class="btn"><span>LME</span> <i class="editLme icon-edit"></i></li>
			<li data-key="weight" data-name="weight" id="weightfield" class="btn"><span>Weight</span></li>
			<li data-key="perimeter" data-name="perimeter" id="perimeterfield" class="btn"><span>Perimeter</span></li>
			<li data-key="arithmetic" data-name="choose" id="arithmeticfield" class="btn"><span>Arithmetic</span> <i class="editArithmetic icon-edit"></i></li>
		</ul>
	</div>
</div>

<!-- Formula Builder -->
<div class="row">
	<div class="span12">
		<ul id="sortable">
			<?php 
			
			if(isset($item->formula) && !empty($item->formula) && $item->formula != '')
			{
				$fields = $this->siebel->formula_to_array($item->formula);
				for ($i = 0; $i < count($fields); $i++)
				{
					$field = $fields[$i];
					$time = now()+$i;
					switch ($field[0]) {
						case 'value':
							echo '<li data-key="value" data-name="'.$field[1].'" id="block'.$time.'" class="btn"><span>'.$field[1].'</span> <i class="editValue icon-edit"></i></li>';
							break;
						
						case 'fix':
							echo '<li data-key="fix" data-name="'.$field[1].'" id="block'.$time.'" class="btn"><span>'.$field[1].'</span> <i class="editValue icon-edit"></i></li>';
							break;

						case 'lme':
							echo '<li data-key="lme" data-name="'.$field[1].'" id="block'.$time.'" class="btn"><span>'.$field[1].'</span> <i class="editLme icon-edit"></i></li>';
							break;

						case 'weight':
							echo '<li data-key="weight" data-name="weight" id="block'.$time.'"  class="btn"><span>Weight</span></li>';
							break;

						case 'perimeter':
							echo '<li data-key="perimeter" data-name="perimeter" id="block'.$time.'"  class="btn"><span>Perimeter</span></li>';
							break;

						case 'arithmetic':
							echo '<li data-key="arithmetic" data-name="'.$field[1].'" id="block'.$time.'" class="btn"><span>'.$field[1].'</span> <i class="editArithmetic icon-edit"></i></li>';
							break;

						default:
							break;
					}
				}
			}
			
			?>
		</ul>
	</div>
</div>

<div class="row">
	<div class="span12">
		<div class="form-actions">
			<a href="#" id="makeFormula" class="btn btn-primary"><?php echo ucfirst($this->siebel->getLang('save')); ?></a>
			<span id="trash" class="pull-right"><i class="icon-trash icon-white"></i> <?php echo ucfirst($this->siebel->getLang('delete')); ?></span>
			<a class="btn btn-danger pull-right" href="<?php echo site_url($module . '/delete/' . $id) ?>"><?php echo ucfirst($this->siebel->getLang('delete')); ?></a>
		</div>
	</div>
</div>

<div class="modal fade" id="editValueModal">
	<div class="modal-body">
		<a class="close" data-dismiss="modal">×</a>
		<div class="input-append">
			<input class="span4" id="name" type="text"><button class="btn btn-primary save" type="button"><i class="icon-ok icon-white"></i></button>
		</div>
	</div>
</div>

<div class="modal fade" id="editArithmeticModal">
	<div class="modal-body">
		<a class="close" data-dismiss="modal">×</a>
		<div class="input-append">
			<select name="arithmetic" id="name">
				<option value="+">+</option>
				<option value="-">-</option>
				<option value="*">*</option>
				<option value="/">/</option>
				<option value="(">(</option>
				<option value=")">)</option>
				<option value="=">=</option>
			</select>
			<button class="btn btn-primary save" type="button"><i class="icon-ok icon-white"></i></button>
		</div>
	</div>
</div>

<div class="modal fade" id="editLmeModal">
	<div class="modal-body">
		<a class="close" data-dismiss="modal">×</a>
		<div class="input-append">
			<select name="lme" id="name">
				<option value="LME-3mth">LME-3mth</option>
				<option value="LME-cash">LME-cash</option>
			</select>
			<button class="btn btn-primary save" type="button"><i class="icon-ok icon-white"></i></button>
		</div>
	</div>
</div>

<?php echo form_close() ?>

<script>
	$(function() {
		$( "#sortable" ).sortable();
		// Trigger for modal to edit the value of a block
		$("#sortable").on("click", "i.editValue", function() {
			$('#editValueModal .save').attr('id', $(this).parent().attr('id'));
			$('#editValueModal #name').val($(this).parent().data('name'));
			
			$('#editValueModal').modal();
		});
		
		// Trigger for modal to edit the value of a block
		$('#editValueModal').on('click', '.save', function() {
			var id = $(this).attr('id');
			$('#sortable #'+id).data('name', $('#editValueModal #name').val());
			$('#sortable #'+id+' span').text($('#editValueModal #name').val());
			$('#editValueModal').modal('hide');
		});
		
		// Trigger for modal to edit the value of a block
		$("#sortable").on("click", "i.editArithmetic", function() {
			$('#editArithmeticModal .save').attr('id', $(this).parent().attr('id'));
			$('#editArithmeticModal').modal();
		});
		
		// Trigger for modal to edit the value of a block
		$('#editArithmeticModal').on('click', '.save', function() {
			var id = $(this).attr('id');
			var newValue = $('#editArithmeticModal #name').val();
			$('#sortable #'+id).data('name', newValue);
			$('#sortable #'+id+' span').text(newValue);
			$('#editArithmeticModal').modal('hide');
		});
		
		// Trigger for modal to edit the value of a block
		$("#sortable").on("click", "i.editLme", function() {
			$('#editLmeModal .save').attr('id', $(this).parent().attr('id'));
			$('#editLmeModal').modal();
		});
		
		// Trigger for modal to edit the value of a block
		$('#editLmeModal').on('click', '.save', function() {
			var id = $(this).attr('id');
			var newValue = $('#editLmeModal #name').val();
			$('#sortable #'+id).data('name', newValue);
			$('#sortable #'+id+' span').text(newValue);
			$('#editLmeModal').modal('hide');
		});
		
		// Drag new items
		$( "#draggable li" ).draggable({
			helper: "clone"
		});
		
		// Drop new items in the sort container
		$( "#sortable" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				var newItem = ui.draggable.clone();
				$(newItem).attr('id', 'block'+$.now());
				$( newItem ).appendTo( this );
			}
		});
		
		/*
		$( "#sortable li" ).draggable({
			connectToSortable: "#trash",
			snap: true,
			revert: false
		});
		*/
	   
		$( "#trash" ).droppable({
			activeClass: "trash-active",
			hoverClass: "trash-hover",
			drop: function( event, ui ) {
				var element = ui.draggable.css('position', '');
				$(this).append(element);
				$(ui.draggable).fadeOut(400, function() {
					$(this).remove();
				});
			}
		});
		
		$( "#sortable" ).disableSelection();
		
		$('#makeFormula').on('click', function(e) {
			e.preventDefault();
			var container = $('input#formula');
			var newFormula = '';
			$('#sortable li').each(function(i, element) {
				var string = $(element).data('key')+':'+$(element).data('name')+'||';
				newFormula += string;
			});
			
			container.val(newFormula);
			$('form').submit();
		});

	});
</script>

