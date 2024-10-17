function addTask() {
    const taskInput = document.getElementById('todo-input');
    const taskText = taskInput.value.trim();

    if (taskText === '') {
        alert('Masukkan Tugas');
        return;
    }

    const taskList = document.getElementById('todo-list');
    const taskItem = document.createElement('li');

    taskItem.innerHTML = `
        <span class="task-text">${taskText}</span>
        <button class="edit-btn" onclick="editTask(this)">✏️</button>
        <button class="delete-btn" onclick="deleteTask(this)">🗑️</button>
    `;

    taskList.appendChild(taskItem);
    taskInput.value = '';
}

function deleteTask(button) {
    const taskItem = button.parentElement;
    taskItem.remove();
}

function editTask(button) {
    const taskItem = button.parentElement;
    const taskTextElement = taskItem.querySelector('.task-text');
    const currentText = taskTextElement.textContent;
    
    const editInput = document.createElement('input');
    editInput.type = 'text';
    editInput.value = currentText;
    editInput.classList.add('edit-input');
    editInput.style.flex = '1';
    editInput.style.marginRight = '10px';
    
    const saveButton = document.createElement('button');
    saveButton.textContent = '💾';
    saveButton.classList.add('save-btn');
    saveButton.style.backgroundColor = '#28a745';
    saveButton.style.color = 'white';
    saveButton.style.border = 'none';
    saveButton.style.borderRadius = '5px';
    saveButton.style.padding = '5px 10px';
    saveButton.style.cursor = 'pointer';
    saveButton.onclick = function() {
        saveTask(taskItem, editInput);
    };
    
    taskItem.innerHTML = '';
    taskItem.appendChild(editInput);
    taskItem.appendChild(saveButton);
}

function saveTask(taskItem, editInput) {
    const newText = editInput.value.trim();

    if (newText === '') {
        alert('Masukkan Tugas');
        return;
    }

    taskItem.innerHTML = `
        <span class="task-text">${newText}</span>
        <button class="edit-btn" onclick="editTask(this)">✏️</button>
        <button class="delete-btn" onclick="deleteTask(this)">🗑️</button>
    `;
}
