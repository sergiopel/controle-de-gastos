# Sistema de Controle de Gastos

Um sistema completo para gerenciamento de finanças pessoais, desenvolvido com Laravel. Acompanhe suas despesas e receitas de forma simples e eficiente.

## Características

- **Gestão de Usuários**: Cadastro, autenticação e perfis de usuário
- **Categorias**: Categorize despesas e receitas
- **Controle de Despesas**: Registre seus gastos com data, valor e categoria
- **Controle de Receitas**: Acompanhe suas entradas financeiras
- **Dashboard**: Visualize resumos e gráficos de sua situação financeira
- **Responsivo**: Acesse de qualquer dispositivo

## Requisitos

- PHP 8.1 ou superior
- Composer
- MySQL ou MariaDB
- Node.js e NPM (para o frontend)

## Instalação

1. Clone o repositório
```bash
git clone https://github.com/seu-usuario/controle-de-gastos.git
cd controle-de-gastos
```

2. Instale as dependências do PHP
```bash
composer install
```

3. Instale as dependências do JavaScript
```bash
npm install
```

4. Crie o arquivo de ambiente
```bash
cp .env.example .env
```

5. Configure o arquivo `.env` com suas credenciais de banco de dados
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=controle_gastos
DB_USERNAME=root
DB_PASSWORD=
```

6. Gere a chave da aplicação
```bash
php artisan key:generate
```

7. Execute as migrações e seeders
```bash
php artisan migrate --seed
```

8. Compile os assets
```bash
npm run dev
```

9. Inicie o servidor
```bash
php artisan serve
```

10. Acesse `http://localhost:8000` no seu navegador

## Estrutura do Projeto

- **Users**: Gerenciamento de usuários e autenticação
- **Categories**: Categorias para despesas e receitas
- **Expenses**: Registro e gestão de despesas
- **Incomes**: Registro e gestão de receitas
- **Dashboard**: Visualização de resumos e estatísticas

## Uso

### Categorias
- O sistema já vem com categorias pré-cadastradas
- Você pode criar suas próprias categorias personalizadas
- As categorias são divididas entre Despesas e Receitas

### Despesas e Receitas
- Todas as transações devem ter uma categoria
- Você pode filtrar por data, categoria e valor
- Visualize relatórios detalhados das suas finanças

## Tecnologias Utilizadas

- **Backend**: Laravel 11+
- **Frontend**: HTML, CSS, JavaScript, Bootstrap 5
- **Database**: MySQL/MariaDB
- **Autenticação**: Laravel Fortify

## Roadmap

### Próxima versão (v1.1)
- [ ] Iniciar o CRUD de receitas e despesas
- [ ] Implementar gráficos

### Versão futura (v1.2)
- [ ] Exportação de relatórios em PDF

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

## Contato

Para dúvidas ou sugestões, entre em contato por email: serpel@gmail.com
