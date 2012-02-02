<?php	##################
	#
	#	rah_status_dropdown-plugin for Textpattern
	#	version 0.4
	#	by Jukka Svahn
	#	http://rahforum.biz
	#
	#	Copyright (C) 2011 Jukka Svahn <http://rahforum.biz>
	#	Licensed under GNU Genral Public License version 2
	#	http://www.gnu.org/licenses/gpl-2.0.html
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

		echo <<<EOF
			<script type="text/javascript">
				<!--
				$(document).ready(function() {
					$('#write-status').append('<select id="rah_status_dropdown" name="Status" class="list"></select>');
					var to = $('#rah_status_dropdown');
					$('#write-status li').each(
						function() {
							var input = $(this).children('input[type=radio]');
							to.append(
								'<option value="'+input.val()+'"'+
									(input.is(':checked') ? ' selected="selected"' : '' )+
								'>' + $(this).children('label').text()+'</option>'
							);
						}
					);
					$('#write-status ul').remove();
				});
				-->
			</script>
EOF;
	}
?>