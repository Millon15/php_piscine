
// deletion of the todo
function delete_todo(param) {
	if (confirm('Do you sure to delete this?')) {
		var task = document.getElementById('ft_list');
		task.removeChild(param);
		setCookie(param.getAttribute("name").trim(), encodeURIComponent(param.innerHTML), -1);
	}
}

function getRndInteger(min, max) {
	return Math.floor(Math.random() * (max - min + 1) ) + min;
}

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires="+ d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

window.onload = function() {
	// Load todos from coockie
	var coo = document.cookie.split(';');

	// Put todos into DOM
	if (coo[0]) {
		var ft_list = document.getElementById('ft_list');
		var arr;
		var i = coo.length - 1;
		for (i; i >= 0; i--) {
			arr = coo[i].split('=');
			ft_list.innerHTML += '<div name="' + arr[0] + '" class="to_do" onclick="delete_todo(this)">' + decodeURIComponent(arr[1]) + '</div>';
		}
	}

	// adding of the new to_do
	document.getElementById('new_todo').onclick = function() {
		var todo_str = prompt('Type some task!', '');
		if (todo_str == null || todo_str == false) {
			return ;
		}
		var ft_list = document.getElementById('ft_list');
		var todos = document.getElementsByClassName("to_do");

		if (todos) {
			var new_todo = document.createElement('div');
			var text_node = document.createTextNode(todo_str);
			new_todo.appendChild(text_node);
			new_todo.classList.add('to_do');
			new_todo.setAttribute('onclick', 'delete_todo(this)');
			ft_list.insertBefore(new_todo, todos[0]);
		}
		else {
			ft_list.innerHTML += '<div class="to_do" onclick="delete_todo(this)">' + todo_str + '</div>';
		}

		// Save changes to coockie
		var fist = document.getElementById('ft_list').children;
		setCookie(getRndInteger(0, 100000), encodeURIComponent(fist[0].innerHTML), 2);
	}
}
