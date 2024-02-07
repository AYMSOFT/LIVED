// ============================================================================ //
// ============== SCRIPT QUE PERMITE MOVER LAS FILAS DE UNA TABLA ============= //
// ============================================================================ //
 
$(function(){
	// ============================================================================ //
	// ============================ ATRIBUTOS DEL DRAG ============================ //
	// ============================================================================ //
	var rowsMove = document.querySelectorAll('.rows-move');
	var fieldsDrag = document.querySelectorAll('.field-drag');

	var isMoveInit = false;
	var clientY = 0;
	var targetDrag = null;
	var lastRowsMove = null;
	
	var changePosition = new CustomEvent('changePosition', { detail : { data : null } });
	
	// ============================================================================ //
	// ============================= METODOS DEL DRAG ============================= //
	// ============================================================================ //
	function addEventSideNodes()
	{
		if (targetDrag.parentNode.parentNode.previousElementSibling) {
			targetDrag.parentNode.parentNode.previousElementSibling.addEventListener('mouseover', mouseOverTop);
		}
		if (targetDrag.parentNode.parentNode.nextElementSibling) {
			targetDrag.parentNode.parentNode.nextElementSibling.addEventListener('mouseover', mouseOverBottom);
		}
	}
	
	function removeEventSideNodes()
	{	
		for (var i = 0; i < rowsMove.length; i++) {
			rowsMove.item(i).removeEventListener('mouseover', mouseOverTop);
			rowsMove.item(i).removeEventListener('mouseover', mouseOverBottom);
		}
	}
	
	function mouseOverTop(e)
	{
		e.preventDefault();
					
		if (isMoveInit) {
			moveRows(rowsMove, targetDrag.parentNode.parentNode, 'top');
			
			removeEventSideNodes();
			
			rowsMove = document.querySelectorAll('.rows-move');
			fieldsDrag = document.querySelectorAll('.field-drag');
			
			for (var i = 0; i < rowsMove.length; i++) {
				if (rowsMove.item(i).id === targetDrag.parentNode.parentNode.id) {
					targetDrag = fieldsDrag.item(i);
				}
			}
			addEventSideNodes();
		}
	}
	
	function mouseOverBottom(e)
	{
		e.preventDefault();
		
		if (isMoveInit) {
			moveRows(rowsMove, targetDrag.parentNode.parentNode, 'bottom');
			
			removeEventSideNodes();
			
			rowsMove = document.querySelectorAll('.rows-move');
			fieldsDrag = document.querySelectorAll('.field-drag');
			
			for (var i = 0; i < rowsMove.length; i++) {
				if (rowsMove.item(i).id === targetDrag.parentNode.parentNode.id) {
					targetDrag = fieldsDrag.item(i);
				}
			}
			addEventSideNodes();
		}
	}
	
	function isChangePosition(lastRowsMove, rowsMove)
	{
		var change = false;
		var numRowsTrue = 0;
		
		for (var i = 0; i < lastRowsMove.length; i++) {
			if (lastRowsMove.item(i).id === rowsMove.item(i).id) {
				numRowsTrue++;
			}
		}
		if (numRowsTrue < lastRowsMove.length) {change = true;}
		return change;
	}
	
	function numberChangePosition(lastRowsMove, rowsMove)
	{
		var numRowsTrue = 0;
		
		for (var i = 0; i < lastRowsMove.length; i++) {
			if (lastRowsMove.item(i).id === rowsMove.item(i).id) {
				numRowsTrue++;
			} else {
				break;
			}
		}
		
		return numRowsTrue;
	}

	
	function moveRows(rowsMoveObjects, rowMoveObject, direction)
	{
		if (!(rowMoveObject.previousElementSibling === null && direction === 'top') && !(rowMoveObject.nextElementSibling === null && direction === 'bottom')) { 
			var nodeInsertSide = direction === 'bottom' ? rowMoveObject.nextElementSibling.nextSibling : rowMoveObject.previousElementSibling;
			rowMoveObject.parentNode.insertBefore(rowMoveObject, nodeInsertSide);
		}
	}
		
	// ============================================================================ //
	// ============================= EVENTOS DEL DRAG ============================= //
	// ============================================================================ //
	for (var i = 0; i < fieldsDrag.length; i++) {
				
		fieldsDrag.item(i).onmousedown = function(e) 
		{
			e.preventDefault();
			isMoveInit = true;
			targetDrag = this;
			lastRowsMove = rowsMove;
			
			addEventSideNodes();
			
			targetDrag.parentNode.parentNode.classList.add('drag-item');
		};
		
		document.onmouseup = function(e) 
		{ 
			if (isMoveInit) {
				e.preventDefault();
				isMoveInit = false;
				
				targetDrag.parentNode.parentNode.classList.remove('drag-item');
				
				removeEventSideNodes();
				
				rowsMove = document.querySelectorAll('.rows-move');
				fieldsDrag = document.querySelectorAll('.field-drag');

				if (isChangePosition(lastRowsMove, rowsMove)) {
					var data = new Array();
					var y = 0;
					for (var i = numberChangePosition(lastRowsMove, rowsMove); i < rowsMove.length; i++) {
						var position = i+1;
						var id = rowsMove.item(i).id;
						data[y] = { position : position, id : id }
						y++;
					}
					changePosition.detail.data = data;
					targetDrag.dispatchEvent(changePosition);
				}
				
			}
		};
	} 

/*=================================================================================== 
============================= DRAG AND DROP LISTA BANNERS ===========================
====================================================================================*/
	
	/* ----------- CAMBIAR EL ORDEN DE LOS BANNERS   --------------- */ 

	$(".field-drag").on('changePosition', function(e) {
		
		var object = $(this);
		var parent = object.parent();
		var grandparents = parent.parent();
		
		var data = JSON.stringify(e.originalEvent.detail.data);
		$.ajax({
			// INCLUSIÓN --> COMPLEMENTO QUE ORDENA LOS FABRICANTES
			url: "/aymcms/actioncms",
			type: "POST",
			data: {data:data, action:'UP'},
			success: function(aym_response){
				$("#aym_page_size").change();
				$('#aym_list_error').html(aym_response);
				parent.removeClass('aym_small_load_opacity');
			},
			error:function(){
				alert("failure");
			}
		});
	});
});