# GiftMed WordPress

Site institucional da GiftMed — Tecnologia Social para Farmácia Solidária.

Stack: **WordPress 6.8**, **PHP 8.2**, **MySQL 8**, tema customizado `giftmedtema`, Docker Compose.

## Estrutura do repositório

```
giftmedwp/
├── docker-compose.yml    # Orquestração local e Coolify
├── .env.example          # Modelo de variáveis (copiar para .env)
├── uploads.ini           # Limites de upload PHP
├── giftmedtema/          # Tema customizado (montado em wp-content/themes/)
└── wp-content/           # Plugins, idiomas e temas padrão WP
```

O banco de dados e os arquivos de `wp-content/uploads/` **não** ficam no Git.

## Desenvolvimento local

### Pré-requisitos

- Docker e Docker Compose

### Primeira execução

```bash
cp .env.example .env
# Edite .env se necessário. Para popular notícias de exemplo na primeira vez:
# GIFTMED_SEED_NOTICIAS=1

docker compose up -d
```

Acesse: http://localhost:8080

Na primeira instalação, conclua o assistente do WordPress no painel. Ative o tema **GiftMed Tema**.

### Comandos úteis

```bash
docker compose up -d          # Subir
docker compose down           # Parar
docker compose logs -f wordpress
docker compose ps
```

### Seed de notícias (somente dev)

O tema pode criar posts fictícios de notícias automaticamente **apenas** quando:

```env
GIFTMED_SEED_NOTICIAS=1
```

Em produção mantenha `GIFTMED_SEED_NOTICIAS=0` (padrão). O seed roda uma única vez por instalação.

## Deploy no Coolify

### 1. Repositório no GitHub

```bash
git checkout -B main
git add .
git commit -m "Preparar deploy Coolify"
git remote add origin https://github.com/SEU_USUARIO/giftmedwp.git
git push -u origin main
```

### 2. Novo recurso no Coolify

1. **New Resource → Docker Compose**
2. Conecte o repositório GitHub e selecione a branch `main`
3. Configure as variáveis de ambiente (use senhas **diferentes** do ambiente local)

### 3. Variáveis obrigatórias no Coolify

| Variável | Exemplo |
|----------|---------|
| `MYSQL_ROOT_PASSWORD` | senha forte única |
| `MYSQL_PASSWORD` | senha forte única |
| `MYSQL_DATABASE` | `wordpress` |
| `MYSQL_USER` | `wordpress` |
| `WORDPRESS_DEBUG` | `0` |
| `WP_HOME` | `https://seudominio.com.br` |
| `WP_SITEURL` | `https://seudominio.com.br` |
| `GIFTMED_SEED_NOTICIAS` | `0` |
| `WORDPRESS_AUTH_KEY` … `WORDPRESS_NONCE_SALT` | gerar em [api.wordpress.org/secret-key/1.1/salt/](https://api.wordpress.org/secret-key/1.1/salt/) |

### 4. Banco de dados

O conteúdo (posts, menus, usuários) está no MySQL, não no Git.

**Exportar do ambiente local:**

```bash
docker compose exec db mysqldump -u wordpress -p wordpress > giftmed-db.sql
```

**Antes de importar em produção**, substitua as URLs:

```bash
sed -i 's|http://localhost:8080|https://seudominio.com.br|g' giftmed-db.sql
```

**Importar no Coolify** (dentro do container do banco):

```bash
mysql -u wordpress -p wordpress < giftmed-db.sql
```

### 5. Uploads (imagens)

Copie `wp-content/uploads/` do ambiente local para o volume/pasta de uploads no servidor. Sem isso, as imagens das notícias não aparecerão.

### 6. Checklist pós-deploy

- [ ] Tema **GiftMed Tema** ativo
- [ ] **Configurações → Links permanentes → Salvar**
- [ ] HTTPS configurado no proxy do Coolify
- [ ] `WORDPRESS_DEBUG=0`
- [ ] `GIFTMED_SEED_NOTICIAS=0`
- [ ] Página inicial, notícias e formulário de contato testados
- [ ] Imagens em `wp-content/uploads/` carregando

## Segurança

- Nunca commite `.env`, dumps `.sql` ou `wp-config.php`
- Use salts únicos em produção
- Mantenha `GIFTMED_SEED_NOTICIAS=0` em produção
- Troque senhas do admin e do banco ao ir para produção

## Licença

Tema GiftMed — uso interno do projeto GiftMed.
