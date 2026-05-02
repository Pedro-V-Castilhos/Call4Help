# Call4Help

Sistema web para abertura e gerenciamento de chamados de suporte técnico.

## Visão Geral

O **Call4Help** permite que duas frentes usem o mesmo sistema:

- **Clientes da empresa**: abrem e acompanham chamados.
- **Funcionários**: visualizam chamados do próprio setor, assumem atendimento e finalizam.

O objetivo é organizar o atendimento interno com um fluxo simples e rastreável.

## Acesso em Produção

- **Laravel Cloud**: https://call4help-main-xb18q6.free.laravel.cloud

## Fluxo do Chamado

1. **Abertura**: usuário cria o chamado informando prioridade e detalhes.
2. **Aceite**: funcionário do setor responsável aceita o chamado.
3. **Fechamento**: funcionário responsável conclui e fecha o chamado.
4. **Cancelamento (opcional)**: se ainda não estiver fechado, o usuário criador pode cancelar.

## Regras de Negócio

- Um chamado é criado por um usuário autenticado.
- Chamados possuem **prioridade** definida no momento da abertura.
- Funcionários atendem chamados do **setor ao qual pertencem**.
- Cancelamento é permitido ao criador enquanto o chamado estiver em andamento.

## Perfis de Usuário

- **Cliente/Usuário solicitante**
    - Abrir chamado.
    - Consultar status.
    - Cancelar chamado não finalizado.

- **Funcionário**
    - Abrir chamado (Para chamados entre setores)
    - Listar chamados do setor.
    - Aceitar chamado.
    - Fechar chamado após resolução.

## Stack Tecnológica

- **Back-end**: Laravel (PHP)
- **Front-end**: Blade + Tailwind CSS
- **Componentes visuais**: Flowbite
- **Banco de dados**: SQLite
- **Build de assets**: Vite

## Estrutura Principal

- `app/Models`: modelos de domínio (`Call`, `Worker`, `Sector`, `Priority`, etc.)
- `app/Http/Controllers`: controladores da aplicação
- `database/migrations`: estrutura das tabelas
- `database/seeders`: dados iniciais para desenvolvimento
- `resources/views`: telas Blade
- `routes/web.php`: rotas web da aplicação

## Como Executar o Projeto

### 1. Instalar dependências

```bash
composer install
npm install
```

### 2. Configurar ambiente

```bash
cp .env.example .env
php artisan key:generate
```

No arquivo `.env`, mantenha configuração SQLite:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

### 3. Preparar banco de dados

Crie o arquivo de banco (caso ainda não exista):

```bash
type nul > database\database.sqlite
```

Execute migrações e seeders:

```bash
php artisan migrate --seed
```

### 4. Rodar aplicação

Em um terminal:

```bash
php artisan serve
```

Em outro terminal:

```bash
npm run dev
```

Acesse em `http://127.0.0.1:8000`.

## Padronização Visual

O projeto utiliza **Tailwind CSS** com componentes **Flowbite** para manter:

- Interface consistente entre páginas.
- Componentes reutilizáveis (botões, tabelas, modais e alertas).
- Estilo uniforme para formulários e estados de chamados.

## Status do Chamado (Resumo)

- **Aberto**: recém-criado, aguardando aceite.
- **Pendente**: assumido por funcionário.
- **Fechado**: atendimento concluído.
- **Cancelado**: interrompido pelo criador antes do fechamento.

## Licença

Projeto acadêmico / interno. Ajuste esta seção conforme a política de licenciamento desejada.
