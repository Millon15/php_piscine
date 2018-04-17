window.onload = function() {
	document.getElementById('new_todo').onclick = function() {
		var todo_str = prompt('Type some task!', '');
		var ft_list = document.getElementById('ft_list');
		var todos = document.getElementsByClassName("to_do");

		if (todos) {
			var new_todo = document.createElement('div');
			var text_node = document.createTextNode(todo_str);
			new_todo.appendChild(text_node);
			new_todo.classList.add('to_do');

			ft_list.insertBefore(new_todo, todos[0]);
		}
		else
			ft_list.innerHTML += '<div class="to_do">' + todo_str + '</div>';
	}
}