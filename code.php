<?php	##################
	#
	#	rah_status_dropdown-plugin for Textpattern
	#	version 0.2
	#	by Jukka Svahn
	#	http://rahforum.biz
	#
	###################

	if(@txpinterface == 'admin')
		register_callback('rah_status_dropdown','admin_side','head_end');

/**
	Changes the radio buttons into dropdown
*/

	function rah_status_dropdown() {
		global $event;

		/*
			If not Write panel, end here
		*/

		if($event != 'article')
			return;

		global $statuses;
		$js = array();

		foreach($statuses as $value => $name)
			$js[] = <<<EOF

					if(valPageLoad == "{$value}")
						list += '<option value="{$value}" selected="selected">{$name}</option>';
					else
						list += '<option value="{$value}">{$name}</option>';
EOF;

		$js = implode('',$js);

		echo <<<EOF
			<script type="text/javascript">
				$(document).ready(function() {
					var valPageLoad = $('#write-status input:checked').val();
					var list = '<select name="Status" class="list">';
					{$js}
					list += '</select>';
					$("#write-status").append(list);
					$("#write-status ul").remove();
				});
			</script>
EOF;
	}