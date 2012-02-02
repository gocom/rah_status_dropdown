<?php	##################
	#
	#	rah_status_dropdown-plugin for Textpattern
	#	version 0.1
	#	by Jukka Svahn
	#	http://rahforum.biz
	#
	###################

	if (@txpinterface == 'admin') register_callback('rah_status_dropdown','article');

	function rah_status_dropdown() {
		global $vars;
		extract(gpsa(array('view','from_view','step','ID')));
		if(!$view || gps('save') || gps('publish')) {
			$view = 'text';
		}
		if(!$step) $step = "create";
		if($step == "edit" && $view == "text" && !empty($ID) && $from_view != 'preview' && $from_view != 'html') $pull = true;
		else {
			$pull = false;
			if($from_view == 'preview' or $from_view == 'html') {
				$store_out = array();
				$store = unserialize(base64_decode(ps('store')));
				foreach($vars as $var) if (isset($store[$var])) $store_out[$var] = $store[$var];
			} else $store_out = gpsa($vars);
			extract($store_out);
		}
		if(!$from_view && !$pull) $Status = 4;
		if(is_numeric(gps('ID'))) $Status = fetch('Status','textpattern','ID',doSlash(gps('ID')));
		if(ps('Status')) $Status = ps('Status');
		$code = rah_status_select($Status);
		echo 
			'<script language="javascript" type="text/javascript">'.n.
			'	$(document).ready(function() {'.n.
			'		$("#write-status ul").remove();'.n.
			'		$("#write-status").append(\''.$code.'\');'.n.
			'	});'.n.
			'</script>';
	}

	function rah_status_select($Status='') {
		global $statuses;
		$Status = ($Status) ? $Status : 4;
		$option = array();
		foreach ($statuses as $a => $b) {
			$option[] = '<option value="'.$a.'"'.(($Status == $a) ? ' selected="selected"' : '').'>'.$b.'</option>';
		}
		return '<select name="Status" class="list">'.implode('',$option).'</select>';
	}
?>