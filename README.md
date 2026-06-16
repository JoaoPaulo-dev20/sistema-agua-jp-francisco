# Sistema de Controle de Consumo de Água

Sistema web para substituir o processo manual de leitura e cobrança de consumo de água de uma associação comunitária. Permite cadastrar consumidores, registrar leituras mensais com cálculo automático de consumo, gerar faturas com valor calculado conforme a regra de cobrança, e configurar as taxas vigentes.

## Dupla

João Paulo e Francisco

## Tecnologias usadas

- Laravel 13 (PHP 8.4)
- MySQL (via XAMPP)
- Bootstrap 5
- Blade (templates)

## Como instalar e rodar o projeto localmente

1. Clone o repositório:
```bash
   git clone https://github.com/JoaoPaulo-dev20/sistema-agua-jp-francisco.git
   cd sistema-agua-jp-francisco
```

2. Instale as dependências:
```bash
   composer install
```

3. Copie o arquivo de ambiente:
```bash
   cp .env.example .env
```

4. Gere a chave da aplicação:
```bash
   php artisan key:generate
```

## Como configurar o .env e rodar as migrations

1. Crie um banco de dados MySQL chamado `sistema_agua` (pode usar o phpMyAdmin do XAMPP).

2. No arquivo `.env`, configure:
```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sistema_agua
   DB_USERNAME=root
   DB_PASSWORD=
```
   > Se a porta 3306 estiver em uso por outro serviço, altere `DB_PORT` no `.env` (e em `C:\xampp\mysql\bin\my.ini`) para uma porta livre, como `3307`.

3. Rode as migrations:
```bash
   php artisan migrate
```

4. Inicie o servidor:
```bash
   php artisan serve
```

5. Acesse `http://127.0.0.1:8000`.

## Funcionalidades

- Cadastro, listagem e edição de consumidores
- Registro de leitura mensal com cálculo automático de consumo (leitura atual − leitura anterior)
- Validação de leitura menor que a anterior e de leitura duplicada no mesmo mês
- Geração automática de fatura com base na regra: taxa fixa até 10.000L, mais R$2,00 por 1.000L excedente
- Listagem de faturas com opção de marcar como paga
- Configuração da taxa fixa e do valor excedente pelo gestor
- Botão de envio da fatura por WhatsApp com mensagem pré-formatada

## Login

O sistema não possui tela de login — não há usuário/senha para testar.