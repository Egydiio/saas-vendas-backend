# 📘 Banco de Dados - SaaS de Vendas

## 🧱 Tabelas

### tenants
Empresas que utilizam o sistema.


| Campo        | Tipo       | Descrição               |
|--------------|------------|-------------------------|
| id           | UUID (PK)  | Identificador único     |
| name         | String     | Nome da empresa         |
| created_at   | Timestamp  | Data de criação         |
| updated_at   | Timestamp  | Última atualização      |

---

### users
Usuários do sistema, ligados a um tenant.

| Campo        | Tipo       | Descrição               |
|--------------|------------|-------------------------|
| id           | UUID (PK)  | Identificador único     |
| tenant_id    | UUID (FK)  | Relacionado a `tenants` |
| name         | String     | Nome do usuário         |
| email        | String     | Email (único por tenant)|
| password     | String     | Hash da senha           |
| role         | Enum       | admin, manager, seller  |
| created_at   | Timestamp  | Data de criação         |
| updated_at   | Timestamp  | Última atualização      |

---

### products
Produtos cadastrados por uma empresa.

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

---

## 🔮 Possíveis expansões futuras

- Módulo de pagamentos
- Faturas (invoices)
- Logs de auditoria
- Integração com marketplaces
- Múltiplos usuários por venda (comissão/vendedores)
- Customização de temas/configurações por tenant

