# Gestão Agrícola API

API REST para gerenciamento de produtores rurais, propriedades, espécies e rebanhos.

## 📋 Descrição do Projeto

Sistema de gestão agrícola desenvolvido com Laravel que permite o cadastro e monitoramento de:
- **Produtores Rurais**: Gestão de informações de produtores (CPF/CNPJ, contato, endereço)
- **Propriedades**: Cadastro de propriedades rurais vinculadas a produtores
- **Espécies**: Registro de espécies de animais criados
- **Rebanhos**: Acompanhamento de rebanhos com quantidade e finalidade

## 🛠️ Tecnologias Utilizadas

- **Framework**: Laravel 13
- **Banco de Dados**: Postgres
- **Container**: Docker & Docker Compose

## 📦 Pré-requisitos

- Docker e Docker Compose
- PHP 8.3+
- Composer
- Node.js e npm

## 🚀 Instalação e Configuração

### 1. Clone o Repositório
```bash
git clone https://github.com/vinialves34/gestao-agro-api
cd gestao-agro-api
```

### 2. Instale as Dependências
```bash
composer install
npm install
```

### 3. Configure o Ambiente
```bash
cp .env.example .env
php artisan key:generate

#IMPORTANTE: Configurar variáveis de ambiente do banco de dados no .env antes de rodar o comando docker-compose
```

### 4. Inicie os Containers Docker
```bash
docker-compose up -d --build
```

### 5. Execute as Migrações
```bash
#ATENÇÃO: Todos comandos de execução ao banco de dados tem que ser executado dentro do container.
#Então acesse o container:
docker exec -it gestao_agro_api bash

#Então no terminal do container execute as migrations.
php artisan migrate
```

### 6. Populate o Banco de Dados
```bash
#ATENÇÃO: Todos comandos de execução ao banco de dados tem que ser executado dentro do container.
#Então acesse o container:
docker exec -it gestao_agro_api bash

#Então no terminal do container execute a seed para a tabela de espécies.
php artisan db:seed
```

## 📊 Estrutura do Banco de Dados

### Tabelas Principais

#### `rural_producers` - Produtores Rurais
- `id` (bigint, PK)
- `name` (string) - Nome do produtor
- `cpf_cnpj` (string, unique) - CPF ou CNPJ
- `phone` (string) - Telefone
- `email` (string, unique) - Email
- `address` (string) - Endereço
- `timestamps`

#### `properties` - Propriedades Rurais
- `id` (bigint, PK)
- `producer_id` (int, FK) - Referência ao produtor
- `name` (string) - Nome da propriedade
- `city` (string) - Cidade
- `state` (string) - Estado
- `state_registration` (string) - Inscrição estadual
- `total_area` (string) - Área total
- `timestamps`

#### `species` - Espécies
- `id` (bigint, PK)
- `name` (string) - Nome da espécie
- `timestamps`

#### `herds` - Rebanhos
- `id` (bigint, PK)
- `property_id` (int, FK) - Referência à propriedade
- `species_id` (int, FK) - Referência à espécie
- `quantity` (int) - Quantidade de animais
- `purpose` (string) - Finalidade (ex: leite, carne, reprodução)
- `timestamps`

## 🔗 Relacionamentos

```
RuralProducer (1) ------ (N) Property
                 \
                  \------- (N) Herd
                           /
Species (1) ----------- (N)
```

## 📝 Modelos Eloquent

### RuralProducer
```php
$producer = RuralProducer::find(1);
$properties = $producer->properties;
```

### Property
```php
$property = Property::find(1);
$producer = $property->producer;
$herds = $property->herds;
```

### Species
```php
$species = Species::find(1);
$herds = $species->herds;
```

### Herd
```php
$herd = Herd::find(1);
$property = $herd->property;
$species = $herd->species;
```

## 🔌 Endpoints da API

### Produtores Rurais
```
GET    /api/rural-producers          - Listar todos
POST   /api/rural-producers          - Criar novo
GET    /api/rural-producers/{id}     - Detalhes
PUT    /api/rural-producers/{id}     - Atualizar
DELETE /api/rural-producers/{id}     - Deletar
```

### Propriedades
```
GET    /api/properties               - Listar todas
POST   /api/properties               - Criar nova
GET    /api/properties/{id}          - Detalhes
PUT    /api/properties/{id}          - Atualizar
DELETE /api/properties/{id}          - Deletar
```

### Espécies
```
GET    /api/species                  - Listar todas
POST   /api/species                  - Criar nova
GET    /api/species/{id}             - Detalhes
PUT    /api/species/{id}             - Atualizar
DELETE /api/species/{id}             - Deletar
```

### Rebanhos
```
GET    /api/herds                    - Listar todos
POST   /api/herds                    - Criar novo
GET    /api/herds/{id}               - Detalhes
PUT    /api/herds/{id}               - Atualizar
DELETE /api/herds/{id}               - Deletar
```

### Relatórios
```
GET    /api/report/total/properties-by-city     - Lista o total de proriedades por municípios
GET    /api/report/total/herds-by-specie        - Lista o total de rebanhos por espécies
```

## 📚 Comandos Úteis

```bash
# Executar migrações
php artisan migrate

# Reverter última migração
php artisan migrate:rollback

# Resetar banco de dados
php artisan migrate:fresh

# Abrir Tinker (shell do Laravel)
php artisan tinker

# Limpar caches
php artisan cache:clear
php artisan config:clear

# Build assets para produção
npm run build

# Desenvolvimento com Vite
npm run dev
```

## 📖 Estrutura de Diretórios

```
app/
├── Http/
│   └── Controllers/
├── Models/
│   ├── RuralProducer.php
│   ├── Property.php
│   ├── Species.php
│   └── Herd.php
└── Providers/

database/
├── migrations/
├── factories/
└── seeders/

routes/
├── api.php
└── web.php

tests/
├── Feature/
└── Unit/

resources/
├── css/
├── js/
└── views/
```

## 🐛 Troubleshooting

### Erro de conexão com banco de dados
Verifique se o container Docker está rodando:
```bash
docker-compose ps
```

### Erro de permissão em storage/logs
```bash
chmod -R 777 storage bootstrap/cache
```

### Limpar cache de aplicação
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```
