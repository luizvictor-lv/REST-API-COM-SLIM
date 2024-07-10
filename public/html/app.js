const apiUrl = 'http://localhost:8000/loja/public/usuarios';

document.addEventListener('DOMContentLoaded', () => {
    loadUsers();

    const userForm = document.getElementById('user-form');
    userForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const userId = document.getElementById('user-id').value;
        if (userId) {
            updateUser(userId);
        } else {
            createUser();
        }
    });
});

function loadUsers() {
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            const userList = document.getElementById('user-list');
            userList.innerHTML = '';
            data.forEach(user => {
                const userRow = document.createElement('tr');
                userRow.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.nome}</td>
                    <td>${user.email}</td>
                    <td>${user.telefone}</td>
                    <td>
                        <button class="edit" onclick="editUser(${user.id})">Editar</button>
                        <button class="delete" onclick="deleteUser(${user.id})">Excluir</button>
                    </td>
                `;
                userList.appendChild(userRow);
            });
        });
}

function createUser() {
    const user = {
        nome: document.getElementById('nome').value,
        email: document.getElementById('email').value,
        telefone: document.getElementById('telefone').value,
        senha: document.getElementById('senha').value,
    };

    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
    })
    .then(response => response.json())
    .then(() => {
        resetForm();
        loadUsers();
    });
}

function editUser(id) {
    fetch(`${apiUrl}/${id}`)
        .then(response => response.json())
        .then(user => {
            document.getElementById('user-id').value = user.id;
            document.getElementById('nome').value = user.nome;
            document.getElementById('email').value = user.email;
            document.getElementById('telefone').value = user.telefone;
        });
}

function updateUser(id) {
    const user = {
        nome: document.getElementById('nome').value,
        email: document.getElementById('email').value,
        telefone: document.getElementById('telefone').value,
        senha: document.getElementById('senha').value,
    };

    fetch(`${apiUrl}/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
    })
    .then(response => response.json())
    .then(() => {
        resetForm();
        loadUsers();
    });
}

function deleteUser(id) {
    fetch(`${apiUrl}/${id}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(() => {
        loadUsers();
    });
}

function resetForm() {
    document.getElementById('user-id').value = '';
    document.getElementById('user-form').reset();
}
