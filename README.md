
# API de Gerenciamento de Cidades, Médicos e Pacientes

Este projeto foi desenvolvido como parte de um teste técnico para a vaga de Desenvolvedor Back-end Pleno. A API gerencia informações sobre cidades, médicos e pacientes, permitindo listar, cadastrar e atualizar dados, com diferentes níveis de acesso baseados em autenticação.

## Tecnologias Usadas

- **Laravel 11** 
- **Laravel Sail** para containers Docker
- **JWT** para autenticação de usuários
- **MySQL** como banco de dados
- **Postman** para testes de integração dos endpoints

## Funcionalidades Implementadas

A API permite realizar operações com as seguintes entidades:

### 1. **Cidade**
- **Listar Cidades:** Endpoint público para listar as cidades cadastradas. Aceita busca por nome e ordenação alfabética.

### 2. **Médico**
- **Listar Médicos:** Endpoint público para listar médicos cadastrados, com suporte a busca por nome e exclusão dos prefixos "dr" e "dra".
- **Listar Médicos por Cidade:** Endpoint para listar médicos de uma cidade específica, com suporte a busca por nome.

### 3. **Paciente**
- **Listar Pacientes de um Médico:** Endpoint autenticado para listar pacientes agendados com um médico, com a possibilidade de filtrar apenas consultas agendadas e busca por nome.
- **Cadastrar Paciente:** Endpoint autenticado para adicionar um novo paciente à base de dados.
- **Atualizar Paciente:** Endpoint autenticado para atualizar os dados de um paciente.

### 4. **Consulta**
- **Agendar Consulta:** Endpoint autenticado para agendar consultas entre médicos e pacientes, passando o ID do médico, ID do paciente e a data.

## Requisitos de Execução

### 1. Configuração do Ambiente

Para rodar o projeto, o ambiente foi configurado utilizando **Laravel Sail**, que usa containers Docker para a aplicação e o banco de dados. Siga os passos abaixo para configurar e rodar a aplicação localmente:

1. **Clone o repositório**:

2. **Instale as dependências do Laravel**:
   ```bash
   composer install
   ```

3. **Inicie o Laravel Sail**:
   ```bash
   ./vendor/bin/sail up -d
   ```

   Isso irá subir o container da aplicação e o banco de dados MySQL.

4. **Crie o banco de dados**:
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

5. **Popule o banco de dados com dados fictícios**:
   ```bash
   ./vendor/bin/sail artisan db:seed
   ```

### 2. Configuração de Autenticação

A autenticação da API utiliza **JWT** (JSON Web Tokens). Para obter um token de autenticação, envie uma requisição POST para o endpoint `/login` com as credenciais do usuário. O token retornado deve ser utilizado no header de autorização (`Authorization: Bearer <token>`) para acessar os endpoints que requerem autenticação.

### 3. Testando os Endpoints com o Postman

Foi usado a coleção no **Postman** [https://web.postman.co/workspace/Teste-Facil-Consulta~8e0c2ff7-b96f-46ad-9b34-d92e10ab9438/collection/23818071-1ee3f4ef-d351-45e2-a38f-1b4940c3ad58?action=share&creator=23818071] com todos os endpoints disponíveis para teste. A coleção inclui exemplos de requisições e respostas para facilitar o teste da API.

## Endpoints
### **Cidade**

- **GET /cidades**: Listar todas as cidades.
- **GET /cidades?nome={nome}**: Buscar cidades pelo nome.

### **Médico**

- **GET /medicos**: Listar todos os médicos.
- **GET /medicos?nome={nome}**: Buscar médicos pelo nome.
- **GET /cidades/{id_cidade}/medicos**: Listar médicos de uma cidade específica.
- **GET /cidades/{id_cidade}/medicos?nome={nome}**: Buscar médicos de uma cidade específica pelo nome.

### **Paciente**

- **GET /medicos/{id_medico}/pacientes**: Listar pacientes agendados para um médico.
- **POST /pacientes**: Cadastrar um novo paciente.
- **PUT /pacientes/{id_paciente}**: Atualizar os dados de um paciente.

### **Consulta**

- **POST /medicos/consulta**: Agendar uma consulta entre médico e paciente.

---

## Estrutura do Banco de Dados

As tabelas principais incluem:

- **Cidades**: Armazena informações sobre as cidades.
- **Médicos**: Armazena informações sobre médicos.
- **Pacientes**: Armazena informações sobre pacientes.
- **Consultas**: Armazena os agendamentos de consultas entre médicos e pacientes.