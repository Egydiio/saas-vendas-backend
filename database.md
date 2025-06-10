# 📘 Banco de Dados - SaaS de Vendas

## 🧱 Tabelas

### plans
Planos de assinatura disponíveis para tenants.

| Campo      | Tipo       | Descrição                      |
|------------|------------|--------------------------------|
| id         | UUID (PK)  | Identificador único            |
| name       | String     | Nome do plano                  |
| price      | Decimal    | Valor mensal                   |
| features   | JSON       | Lista de features do plano     |
| created_at | Timestamp  | Data de criação                |
| updated_at | Timestamp  | Última atualização             |

---

### tenants
Empresas que utilizam o sistema.

#### Relacionamentos:
- tenant->hasMany(users)
- tenant->hasMany(products)
- tenant->hasMany(customers)
- tenant->hasMany(sales)
- tenant->belongsTo(plan)
- tenant->hasMany(tenant_permissions)
- tenant->hasMany(tenant_modules)

| Campo      | Tipo       | Descrição           |
|------------|------------|---------------------|
| id         | UUID (PK)  | Identificador único |
| plan_id    | UUID (FK)  | Relacionado a `plans` |
| name       | String     | Nome da empresa     |
| created_at | Timestamp  | Data de criação     |
| updated_at | Timestamp  | Última atualização  |
| deleted_at | Timestamp  | Data de desativação |

---

### users
Utilizadores do sistema, ligados a um tenant.

#### Relacionamentos:
- user->belongsTo(tenant)
- user->hasMany(sales)
- user->hasMany(user_rules)

| Campo        | Tipo       | Descrição                          |
|--------------|------------|------------------------------------|
| id           | UUID (PK)  | Identificador único                |
| tenant_id    | UUID (FK)  | Relacionado a `tenants`            |
| name         | String     | Nome do usuário                    |
| email        | String     | Email (único por tenant)           |
| password     | String     | Hash da senha                      |
| role         | String     | Papel do usuário no sistema        |
| created_at   | Timestamp  | Data de criação                    |
| updated_at   | Timestamp  | Última atualização                 |
| deleted_at   | Timestamp  | Data de exclusão (para soft delete)|

---

### permissions
Permissões do sistema (ex: acessar módulo X, exportar dados, etc).

| Campo        | Tipo       | Descrição                |
|--------------|------------|--------------------------|
| id           | UUID (PK)  | Identificador único      |
| name         | String     | Nome da permissão        |
| description  | String     | Descrição da permissão   |
| created_at   | Timestamp  | Data de criação          |
| updated_at   | Timestamp  | Última atualização       |

---

### tenant_permissions
Permissões habilitadas para cada tenant (por plano ou módulos extras).

| Campo          | Tipo       | Descrição                    |
|----------------|------------|------------------------------|
| id             | UUID (PK)  | Identificador único          |
| tenant_id      | UUID (FK)  | Relacionado a `tenants`      |
| permission_id  | UUID (FK)  | Relacionado a `permissions`  |
| enabled        | Boolean    | Permissão ativa/desativada   |
| created_at     | Timestamp  | Data de criação              |
| updated_at     | Timestamp  | Última atualização           |

---

### rules
Regras de acesso para usuários (ex: pode editar produto, pode ver relatório).

| Campo        | Tipo       | Descrição                |
|--------------|------------|--------------------------|
| id           | UUID (PK)  | Identificador único      |
| name         | String     | Nome da regra            |
| description  | String     | Descrição da regra       |
| created_at   | Timestamp  | Data de criação          |
| updated_at   | Timestamp  | Última atualização       |

---

### user_rules
Regras atribuídas a usuários.

| Campo        | Tipo       | Descrição                     |
|--------------|------------|-------------------------------|
| id           | UUID (PK)  | Identificador único           |
| user_id      | UUID (FK)  | Relacionado a `users`         |
| rule_id      | UUID (FK)  | Relacionado a `rules`         |
| enabled      | Boolean    | Regra ativa/desativada        |
| created_at   | Timestamp  | Data de criação               |
| updated_at   | Timestamp  | Última atualização            |

---

### tenant_modules
Módulos extras adquiridos por tenant (ex: módulo de relatórios avançados).

| Campo        | Tipo       | Descrição                      |
|--------------|------------|--------------------------------|
| id           | UUID (PK)  | Identificador único            |
| tenant_id    | UUID (FK)  | Relacionado a `tenants`        |
| module_name  | String     | Nome do módulo                 |
| enabled      | Boolean    | Módulo ativo/desativado        |
| acquired_at  | Timestamp  | Data de aquisição              |
| created_at   | Timestamp  | Data de criação                |
| updated_at   | Timestamp  | Última atualização             |

---

### products
Produtos cadastrados por uma empresa.

#### Relacionamentos:
- product->belongsTo(tenant)
- product->hasMany(saleItems)
- product->belongsTo(category)

| Campo        | Tipo       | Descrição                          |
|--------------|------------|------------------------------------|
| id           | UUID (PK)  | Identificador único                |
| tenant_id    | UUID (FK)  | Relacionado a `tenants`            |
| category_id  | UUID (FK)  | Categoria do produto               |
| name         | String     | Nome do produto                    |
| description  | Text       | Descrição do produto               |
| price        | Integer    | Preço unitário                     |
| stock        | Integer    | Quantidade em estoque              |
| created_at   | Timestamp  | Data de criação                    |
| updated_at   | Timestamp  | Última atualização                 |
| deleted_at   | Timestamp  | Data de exclusão (para soft delete)|

---

### customers
Clientes das empresas (finais).

#### Relacionamentos:
- customer->belongsTo(tenant)
- customer->hasMany(sales)
- customer->hasMany(addresses)

| Campo        | Tipo       | Descrição                          |
|--------------|------------|------------------------------------|
| id           | UUID (PK)  | Identificador único                |
| tenant_id    | UUID (FK)  | Relacionado a `tenants`            |
| name         | String     | Nome do cliente                    |
| email        | String     | Email                              |
| phone        | String     | Telefone                           |
| document     | String     | CPF/CNPJ                           |
| created_at   | Timestamp  | Data de criação                    |
| updated_at   | Timestamp  | Última atualização                 |
| deleted_at   | Timestamp  | Data de exclusão (para soft delete)|

---

### sales
Pedidos de venda realizados.

#### Relacionamentos:
- sale->belongsTo(tenant)
- sale->belongsTo(user)
- sale->belongsTo(customer)
- sale->hasMany(items)

| Campo        | Tipo       | Descrição                                |
|--------------|------------|------------------------------------------|
| id           | UUID (PK)  | Identificador único                      |
| tenant_id    | UUID (FK)  | Relacionado a `tenants`                  |
| user_id      | UUID (FK)  | Quem realizou a venda                    |
| customer_id  | UUID (FK)  | Cliente final                            |
| status       | Enum       | Status da venda (pendente, paga, etc.)   |
| total        | Integer    | Valor total da venda                     |
| created_at   | Timestamp  | Data da venda                            |
| updated_at   | Timestamp  | Última atualização                       |
| deleted_at   | Timestamp  | Data de exclusão (para soft delete)      |

---

### sale_items
Itens vendidos em um pedido.

#### Relacionamentos:
- saleItem->belongsTo(sale)
- saleItem->belongsTo(product)

| Campo      | Tipo      | Descrição                 |
|------------|-----------|---------------------------|
| id         | UUID (PK) | Identificador único       |
| sale_id    | UUID (FK) | Relacionado a `sales`     |
| product_id | UUID (FK) | Produto vendido           |
| quantity   | Integer   | Quantidade vendida        |
| unit_price | Integer   | Preço do produto na venda |
| created_at | Timestamp | Data de criação           |
| updated_at | Timestamp | Última atualização        |

---

### product_categories
Categorias para organizar produtos.

| Campo        | Tipo       | Descrição                          |
|--------------|------------|------------------------------------|
| id           | UUID (PK)  | Identificador único                |
| tenant_id    | UUID (FK)  | Relacionado a `tenants`            |
| name         | String     | Nome da categoria                  |
| description  | Text       | Descrição da categoria             |
| created_at   | Timestamp  | Data de criação                    |
| updated_at   | Timestamp  | Última atualização                 |

---

### customer_addresses
Endereços dos clientes.

| Campo        | Tipo       | Descrição                          |
|--------------|------------|------------------------------------|
| id           | UUID (PK)  | Identificador único                |
| customer_id  | UUID (FK)  | Relacionado a `customers`          |
| type         | String     | Tipo (entrega, cobrança, etc)      |
| street       | String     | Rua                                |
| number       | String     | Número                             |
| complement   | String     | Complemento                        |
| district     | String     | Bairro                             |
| city         | String     | Cidade                             |
| state        | String     | Estado                             |
| postal_code  | String     | CEP                                |
| is_default   | Boolean    | Endereço padrão                    |
| created_at   | Timestamp  | Data de criação                    |
| updated_at   | Timestamp  | Última atualização                 |

---

### payments
Pagamentos das vendas.

| Campo        | Tipo      | Descrição                          |
|--------------|-----------|------------------------------------|
| id           | UUID (PK) | Identificador único                |
| tenant_id    | UUID (FK) | Relacionado a `tenants`            |
| sale_id      | UUID (FK) | Relacionado a `sales`              |
| method       | String    | Método de pagamento                |
| status       | String    | Status do pagamento                |
| amount       | Integer   | Valor do pagamento                 |
| payment_date | Timestamp | Data do pagamento                  |
| created_at   | Timestamp | Data de criação                    |
| updated_at   | Timestamp | Última atualização                 |

---

### price_history
Histórico de alterações de preços de produtos.

| Campo        | Tipo      | Descrição                 |
|--------------|-----------|---------------------------|
| id           | UUID (PK) | Identificador único       |
| product_id   | UUID (FK) | Relacionado a `products`  |
| old_price    | Integer   | Preço anterior            |
| new_price    | Integer   | Novo preço                |
| changed_by   | UUID (FK) | Relacionado a `customers` |
| created_at   | Timestamp | Data da alteração         |

---


## 🛡️ Considerações sobre segurança

- Toda query de leitura/escrita **deve filtrar pelo `tenant_id`** para isolar os dados de cada empresa.
- Use autenticação JWT ou sessions + middleware multi-tenant.
- O campo `role` em `users` pode ser usado para controle básico de permissões.
- Use as tabelas de `permissions` e `rules` para granularidade de acesso por tenant e usuário.

---

## 🔮 Possíveis expansões futuras

- Módulo de pagamentos
- Faturas (invoices)
- Logs de auditoria
- Integração com marketplaces
- Múltiplos usuários por venda (comissão/vendedores)
- Customização de temas/configurações por tenant
- Webhooks para integrações externas
- API Keys por tenant
- Limites de uso por plano
