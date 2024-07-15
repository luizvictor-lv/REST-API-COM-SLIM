<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #444;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 300px;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="number"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px 15px;
            border: none;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .btn-back {
            margin-top: 10px;
            padding: 10px 15px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }

        #result {
            margin-top: 20px;
            width: 300px;
        }

        .user {
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Pesquisar Por Nome</h1>
    <form id="searchByNameForm">
        <input type="text" name="nome" id="nome" placeholder="Nome" required>
        <button type="submit">Pesquisar</button>
    </form>
    <h1>Pesquisar Por ID</h1>
    <form id="searchByIdForm">
        <input type="number" name="id" id="id" placeholder="ID" required>
        <button type="submit">Pesquisar</button>
    </form>
    <div id="result"></div>
    <a href="cadastra.html" class="btn-back">Cadastrar Novo Usuário</a>
    <a href="atualizar.html" class="btn-back">Editar Usuario</a>
    <a href="delete.html" class="btn-back">Apagar Usuario</a>
    
    <script>
        document.getElementById('searchByNameForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const nome = document.getElementById('nome').value;
            const arrayNome = nome.split(" ")
            let url = 'http://localhost:8000/loja/public/usuarios/?nome='
            arrayNome.forEach(itemNome => {
                url += itemNome + '+'
            })
           
            fetch(`http://localhost:8000/loja/public/usuarios/?nome=${nome}`)
                .then(response => response.json())
                .then(data => displayResults(data))
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('searchByIdForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const id = document.getElementById('id').value;
            
            fetch(`http://localhost:8000/loja/public/usuarios/%7Bid%7D?id=${id}`)
                .then(response => response.json())
                .then(data => displayResults([data]))
                .catch(error => console.error('Error:', error));
        });

        function displayResults(data) {
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = '';
            data.forEach(user => {
                const userDiv = document.createElement('div');
                userDiv.classList.add('user');
                userDiv.innerHTML = `<p>ID: ${user.id}</p><p>Nome: ${user.nome}</p> <p>E-Mail: ${user.email}<p> <p>Telefone: ${user.telefone}`;
                resultDiv.appendChild(userDiv);
            });
        }
    </script>
</body>
</html>
