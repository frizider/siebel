<?php

class Bootstrap
{
	
	// Creates a dropdownlist
	public function dropdown($subnav = FALSE, $label = FALSE, $name, $dataName, $values, $class = FALSE, $icon = FALSE, $hiddenValue = FALSE, $inline = FALSE) 
	{
		$ci = get_instance();
		
		$return = '';
		
		if(!$subnav)
		{
			if(!$inline)
			{
				$return .= '<div class="control-group">';
			}
			
			
			if($label)
			{
				$return .= form_label(ucfirst($label), $dataName, array('class' => 'control-label'));
			}

		}
		
		$normalClass = ($subnav) ? '' : 'normal';
		
		$return .= form_input(
				array(
					'name' => $dataName,
					'id' => $dataName,
					'class' => $dataName,
					'type' => 'hidden',
					'value' => $hiddenValue
				));
		$controlclass = ($inline) ? 'inline' : 'controls';
		if(!$subnav)
		{
			$return .= '<div class="'.$controlclass.'">';
		}
		
		$return .= '<li class="dropdown '.$class.' '.$normalClass.'" id="dropdown">
				<a href="#" class="dropdown-toggle '.$dataName.'" data-toggle="dropdown">';
		
		if($icon) 
		{
			$return .= '<i class="'.$icon.'"></i> '; 
		} 
		
		$return .= '<span>'.$name.'</span> <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li class="dropdown" data-name="'.$dataName.'">
					<a href="#" data-value="" data-name="'.ucfirst($ci->siebel->getLang('choose')).'">&nbsp;</a>';
		
		foreach($values as $key => $value) 
		{
			$return .= '<a href="#" data-value="'.$key.'" data-name="'.ucfirst($value).'">'.ucfirst($value).'</a>';
		}
		
		$return .= '</li></ul></li>';
		//
		
		if(!$subnav)
		{
			if(!$inline)
			{
				$return .= '</div>';
			}
			$return .= '</div>';
		}
		
		return $return;
	}
	
	// Creates a heading block
	public function heading($type, $title, $small = FALSE, $prefix = FALSE, $rowClass = FALSE) 
	{
		$return =	'<div class="row'.$rowClass.'">
						<div class="span12">
							<h'.$type.' class="title">' . $prefix . ucfirst($title) . ' <small class="pull-right">'.$small.'</small></h'.$type.'>
						</div>
					</div>';
		
		return $return;
	}
	
	// Creates a form group with label and input field(s)
	public function formControlGroup($label = array(), $inputfields = array(), $suffix = FALSE, $append = FALSE, $prepend = FALSE) 
	{
		$return = '<div class="control-group">
					'.form_label(ucfirst($label[0]), $label[1], $label[2]).'
					<div class="controls">';
		
		$preAppendClass = '';
		if($append)
		{
			$preAppendClass .= ' input-append';
		}
		if($prepend)
		{
			$preAppendClass .= ' input-prepend';
		}
		
		$return .= '<div class="'.$preAppendClass.'">';
		
		if($prepend)
		{
			$return .= $prepend;
		}
		
		foreach($inputfields as $input) {
			$return .= form_input($input);
		}
		
		if($append)
		{
			$return .= $append;
		}
		$return .= '</div>';
		
		$return .= $suffix.'</div></div>';
		
		return $return;

	}
	
	public function radio($label, $dataName, $current, $values, $inline = FALSE)
	{
		$return = '';
		if($label)
		{
			$return .= '<div class="control-group">
						'.form_label(ucfirst($label[0]), $label[1], $label[2]).'
						<div class="controls">';

		}
		
		$return .= form_input(
				array(
					'name' => $dataName,
					'id' => $dataName,
					'class' => $dataName,
					'type' => 'hidden',
					'value' => $current
				));
		
		foreach($values as $key => $value) {
			$check = ($key == $current) ? 'checked' : '';
			$inline = ($inline) ? 'pull-left' : '';
			$return .= '<label class="radio '.$inline.' '.$check.'" data-name="'.$dataName.'" data-value="'.$key.'"><a href="#" class="radio-wrapper"><span class="cb-inner"><i class="icon-white"></i></span></a>'.$value.'</label>';
		}
		
		if($label)
		{
			$return .= '</div></div>';			
		}
		
		return $return;
	}
	
	public function checkbox($label, $dataName, $current, $values, $inline = FALSE, $group = FALSE)
	{
		$return = '';
		if($label)
		{
			$return .= '<div class="control-group">
						'.form_label(ucfirst($label[0]), $label[1], $label[2]).'
						<div class="controls">';

		}
		
		$return .= form_input(
				array(
					'name' => ($group) ? $group.'['.$dataName.']' : $dataName,
					'id' => $dataName,
					'class' => $dataName,
					'type' => 'hidden',
					'value' => $current
				));
		
		foreach($values as $key => $value) {
			$check = ($current != 0) ? 'checked' : '';
			$check_icon = ($current != 0) ? 'icon-ok' : '';
			$inline = ($inline) ? 'pull-left' : '';
			$return .= '<label class="checkbox '.$inline.' '.$check.'" data-name="'.$dataName.'" data-value="'.$key.'"><a href="#" class="checkbox-wrapper"><span class="cb-inner"><i class="'.$check_icon.' icon-white"></i></span></a>'.$value.'</label>';
		}
		
		if($label)
		{
			$return .= '</div></div>';			
		}
		
		return $return;
	}
	
	public function alert($text, $class = '') 
	{
		return '<div class="alert '.$class.'"><a class="close" data-dismiss="alert"></a>'.$text.'</div>';

	}
	
	public function navItem($perm, $current_page, $href, $lang, $extraClasses = FALSE, $icon = FALSE)
	{
		$ci = get_instance();
		if(perm($perm))
		{
			$active = ($ci->uri->uri_string() == $current_page) ? 'active ' : ' ';
			$return = '<li class="'.$active.$extraClasses.'"><a href="'.site_url($href).'"><i class="'.$icon.'"></i> '.ucfirst($ci->siebel->getLang($lang)).'</a></li>';
		}
		else
		{
			$return = FALSE;
		}
		
		return $return;

	}
	
}

?>
