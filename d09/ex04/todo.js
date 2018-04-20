function HTMLEncode(str){
	var i = str.length,
		aRet = [],
		iC;

	while (i--) {
		iC = str[i].charCodeAt();
		if (iC < 65 || iC > 127 || (iC > 90 && iC < 97))
			aRet[i] = '&#' + iC + ';';
		else
			aRet[i] = str[i];
	}
	return aRet.join('');
}

$('document').ready(function() {
	var $ft_list = $('#ft_list');

	// Load todos from csv via ajax
	$.ajax({
		url: 'select.php',
		success: function(data) {
			var arr = JSON.parse(data);

			for (key in arr) {
				if (key && arr[key])
					$ft_list.prepend('<div class="to_do ' + key + '">' + decodeURIComponent(arr[key]) + '</div>');
			}
		},
		error: function(){ alert('Error reading todos'); },
	});

	// adding of the new to_do
	$('#new_todo').click(function() {
		var todo_str = prompt('Type some task!', '');
		todo_str = todo_str.trim();
		if (!todo_str) {
			alert('You cannot set an empty todo!');
			return ;
		}
		todo_str = HTMLEncode(todo_str);

		$.ajax({
			type: 'POST',
			url: 'insert.php',
			data: {
				id: 0,
				name: encodeURIComponent(todo_str),
			},
			success: function(data) {
				$ft_list.prepend('<div class="to_do ' + data + '">' + todo_str + '</div>');
			},
			error: function(){ alert('Error adding todo'); },
		});
	});

	// deletion of the todo
	$(document).on('click', '.to_do', function () {
		if (confirm('Do you sure to delete this?')) {
			var $id = $(this).attr('class').replace('to_do ', '');

			$.ajax({
				type: 'POST',
				url: 'delete.php',
				data: {
					id: $id,
				},
				success: function(data) {
					$('.' + $id).remove();
				},
				error: function(){ alert('Error deleting todo'); },
			});
		}
	});
});