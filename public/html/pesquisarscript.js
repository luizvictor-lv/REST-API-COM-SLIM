const apiUrl = 'http://localhost:8000/loja/public/usuarios';

document.getElementById('pesquisaForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const getUsuarioId = document.getElementById('getUsuarioId').value;

    try {
        const response = await fetch(`/usuarios/${getUsuarioId}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const result = await response.json();

        if (response.ok) {
            // Constrói a exibição do resultado, por exemplo:
            const resultadoHTML = `
                <h2>Detalhes do Usuário</h2>
                <p><strong>ID:</strong> ${result.id}</p>
                <p><strong>Nome:</strong> ${result.nome}</p>
                <p><strong>Email:</strong> ${result.email}</p>
                <p><strong>Telefone:</strong> ${result.telefone}</p>
            `;
            document.getElementById('resultado').innerHTML = resultadoHTML;
        } else {
            document.getElementById('resultado').innerText = `Usuário não encontrado ou erro na pesquisa.`;
        }
    } catch (error) {
        console.error('Erro na requisição:', error);
        document.getElementById('resultado').innerText = 'Erro ao buscar Usuário. Por favor, tente novamente.';
    }
});
