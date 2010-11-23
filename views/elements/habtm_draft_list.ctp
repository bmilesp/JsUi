<?php
$label = (isset($label))? $label : 'Product';
$dataName = (isset($dataName))? $dataName : 'Product';
$loop_append_id = (isset($loop_append_id))? 'log_'.$loop_append_id : 'log';
$url = (isset($url))? $url : null;
$fieldname = (isset($fieldname))? $fieldname : 'DraftList.draftlist';
$input_id = (isset($container_id))? $container_id : 'draft_container';
$spinnerUrl = (isset($spinnerUrl))? $spinnerUrl : Router::url('/js_ui/img/ui-anim_basic_16x16.gif');
?>
<style>
	.ui-autocomplete-loading { background: white url(<?php echo $spinnerUrl ?>) right center no-repeat; }
	#draftedItemDummy{display:none}
</style>
<fieldset>
	<legend><?php __($label); ?></legend>
	<input id="<?php echo $input_id?>" />
	<div id="<?php echo $loop_append_id ?>">
		<?php 
		if (isset($this->data[$dataName][0]) && !empty($this->data[$dataName][0])){
			foreach($this->data[$dataName] as $p){?>
				<div id="draftedItem">
					<input type='hidden' name='data[<?php echo $dataName?>][<?php echo $dataName?>][]' value='<?php echo $p['id']?>'>
					<span class='drafted_item_text'><?php echo urldecode($p['name'])?></span>
					<a href='javascript:void(0)' onclick='removeDraftedItem(event)'>Remove</a>
				</div>
			<?php }	
		}
		?>
	</div>
</fieldset>
<script>
	var cloneCount = 0;
	$(function() {
		function log( message, id ) {
			var itemCopy = $('#draftedItemDummy').clone().appendTo('#<?php echo $loop_append_id?>');
			itemCopy.append('<input class="drafted_item_text_input" type="hidden" name="data[<?php echo $dataName?>][<?php echo $dataName?>][]">')
			itemCopy.find('input').attr('id', 'draftedItem_'+cloneCount);
			itemCopy.find('input').val(id);
			itemCopy.find('span.drafted_item_text').html(message);	
			itemCopy.slideDown(500, function(){itemCopy.show(0)});
			$( "#<?php echo $loop_append_id ?>" ).attr( "scrollTop", 0 );
		}

		$( "#<?php echo $input_id?>" ).autocomplete({
			source: "<?php echo $url?>",
			minLength: 2,
			select: function( event, ui ) {
				log( (ui.item ?
					ui.item.label  :
					"Nothing selected, input was " + this.value), ui.item.id );
			}
		});
	});

	function removeDraftedItem(e){
		var currentTarget = e.currentTarget;
		$(currentTarget).parent().slideUp(500, draftItemRemove(currentTarget));
	}

	function draftItemRemove(c){
		$(c).parent().remove();
	}
</script>

<div id="draftedItemDummy">
<span class='drafted_item_text'></span>
<a href='javascript:void(0)' onclick='removeDraftedItem(event)'>Remove</a>
</div>