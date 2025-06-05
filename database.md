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
Usuários do sistema, ligados a um tenant.

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
| role         | Enum       | SuperAdmin, admin, manager, seller |
| created_at   | Timestamp  | Data de criação                    |
| updated_at   | Timestamp  | Última atualização                 |

---

### permissions
Permissões do sistema (ex: acessar módulo X, exportar dados, etc).

| Campo        | Tipo       | Descrição                |
|--------------|------------|--------------------------|
| id           | UUID (PK)  | Identificador único      |
| name         | String     | Nome da permissão        |
| description  | String     | Descrição da permissão   |

---

### tenant_permissions
Permissões habilitadas para cada tenant (por plano ou módulos extras).

| Campo           | Tipo       | Descrição                       |
|-----------------|------------|---------------------------------|
| id              | UUID (PK)  | Identificador único             |
| tenant_id       | UUID (FK)  | Relacionado a `tenants`         |
| permission_id   | UUID (FK)  | Relacionado a `permissions`     |
| enabled         | Boolean    | Permissão ativa/desativada      |

---

### rules
Regras de acesso para usuários (ex: pode editar produto, pode ver relatório).

| Campo        | Tipo       | Descrição                |
|--------------|------------|--------------------------|
| id           | UUID (PK)  | Identificador único      |
| name         | String     | Nome da regra            |
| description  | String     | Descrição da regra       |

---

### user_rules
Regras atribuídas a usuários.

| Campo        | Tipo       | Descrição                       |
|--------------|------------|---------------------------------|
| id           | UUID (PK)  | Identificador único             |
| user_id      | UUID (FK)  | Relacionado a `users`           |
| rule_id      | UUID (FK)  | Relacionado a `rules`           |
| enabled      | Boolean    | Regra ativa/desativada          |

---

### tenant_modules (opcional)
Módulos extras adquiridos por tenant (ex: módulo de relatórios avançados).

| Campo        | Tipo       | Descrição                       |
|--------------|------------|---------------------------------|
| id           | UUID (PK)  | Identificador único             |
| tenant_id    | UUID (FK)  | Relacionado a `tenants`         |
| module_name  | String     | Nome do módulo                  |
| enabled      | Boolean    | Módulo ativo/desativado         |
| acquired_at  | Timestamp  | Data de aquisição               |

---

### products
Produtos cadastrados por uma empresa.

#### Relacionamentos:
- product->belongsTo(tenant)
- product->hasMany(saleItems)

| Campo        | Tipo       | Descrição               |
|--------------|------------|-------------------------|
| id           | UUID (PK)  | Identificador único     |
| tenant_id    | UUID (FK)  | Relacionado a `tenants` |
| name         | String     | Nome do produto         |
| price        | Decimal    | Preço unitário          |
| stock        | Integer    | Quantidade em estoque   |
| created_at   | Timestamp  | Data de criação         |
| updated_at   | Timestamp  | Última atualização      |

---

### customers
Clientes das empresas (finais).

#### Relacionamentos:
- customer->belongsTo(tenant)
- customer->hasMany(sales)

| Campo        | Tipo       | Descrição               |
|--------------|------------|-------------------------|
| id           | UUID (PK)  | Identificador único     |
| tenant_id    | UUID (FK)  | Relacionado a `tenants` |
| name         | String     | Nome do cliente         |
| email        | String     | Email                   |
| phone        | String     | Telefone                |
| created_at   | Timestamp  | Data de criação         |
| updated_at   | Timestamp  | Última atualização      |

---

### sales
Pedidos de venda realizados.

#### Relacionamentos:
- sale->belongsTo(tenant)
- sale->belongsTo(user)
- sale->belongsTo(customer)
- sale->hasMany(items)

| Campo        | Tipo       | Descrição               |
|--------------|------------|-------------------------|
| id           | UUID (PK)  | Identificador único     |
| tenant_id    | UUID (FK)  | Relacionado a `tenants` |
| user_id      | UUID (FK)  | Quem realizou a venda   |
| customer_id  | UUID (FK)  | Cliente final           |
| total        | Decimal    | Valor total da venda    |
| created_at   | Timestamp  | Data da venda           |

---

### sale_items
Itens vendidos em um pedido.

#### Relacionamentos:
- saleItem->belongsTo(sale)
- saleItem->belongsTo(product)

| Campo        | Tipo       | Descrição                   |
|--------------|------------|-----------------------------|
| id           | UUID (PK)  | Identificador único         |
| sale_id      | UUID (FK)  | Relacionado a `sales`       |
| product_id   | UUID (FK)  | Produto vendido             |
| quantity     | Integer    | Quantidade vendida          |
| unit_price   | Decimal    | Preço do produto na venda   |

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

