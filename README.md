# GiftMed WordPress

Site institucional da GiftMed — Tecnologia Social para Farmácia Solidária.

Stack: **WordPress 6.8**, **PHP 8.2**, **MySQL 8**, tema customizado `giftmedtema`, Docker Compose.

## Estrutura do repositório

```
giftmedwp/
├── docker-compose.yaml          # Orquestração local e Coolify
├── docker-compose.override.yaml # Porta 8080 só no dev local
├── Dockerfile.wordpress         # Imagem com limite de upload PHP
├── .env.example                 # Modelo de variáveis
├── uploads.ini                  # Limites PHP (embutido na imagem)
├── giftmedtema/                 # Tema customizado (inc/, Customizer, templates)
├── deploy/                      # Staging FTP (.sql, uploads) — não versionado
└── wp-content/                  # Plugins, mu-plugins, uploads
    └── mu-plugins/              # Hardening (AI1WM off por padrão)
```

O banco de dados, dumps `.sql`, ZIPs, idiomas `pt_BR`, temas Twenty* e `wp-content/uploads/` **não** ficam no Git.

### Conteúdo editável (Customizer)

Em **Aparência → Personalizar → GiftMed Conteúdo**:
- Hero / topbar (textos e CTAs)
- A Solução, O Desafio (cards principais), Como Funciona / Recursos / Impacto (cabeçalhos)
- Contato e redes (e-mails, Instagram, YouTube, TikTok, textos do formulário)
- Parceiros (texto, exibir/ocultar, nome, tag, logo)

### Cards das seções (Posts)

Edite como posts normais, filtrando pela categoria:

| Categoria | Seção na home |
|-----------|----------------|
| `Desafio` | Dimensões do problema |
| `Como Funciona` | Etapas do fluxo |
| `Funcionalidades` | Módulos/recursos |
| `Impacto` | Métricas social/ambiental/econômico |
| `Diferenciais` | Cards “Por que a GiftMed é diferente?” |
| `Notícias` | Painel de notícias |

No editor do post, use o campo **Ícone da seção (emoji)** na barra lateral.

### Seed de conteúdo (somente local)

```bash
docker compose exec wordpress wp giftmedtema seed-conteudo --allow-root
# ou só seções / só notícias:
docker compose exec wordpress wp giftmedtema seed-secoes --allow-root
docker compose exec wordpress wp giftmedtema seed-noticias --allow-root
```

### All-in-One WP Migration

Fica **desativado** pelo mu-plugin. Para usar temporariamente:

```env
GIFTMED_ALLOW_MIGRATION=1
```


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

## FTP (upload de arquivos)

Serviço opcional para enviar `uploads/` e dumps `.sql` sem SSH.

### Subir com FTP (local ou Coolify)

1. Defina no `.env` ou no Coolify:
   ```env
   FTP_USER=giftmed
   FTP_PASSWORD=senha_forte_unica
   FTP_PUBLIC_HOST=IP_PUBLICO_DO_SERVIDOR
   ```
2. No Coolify, libere no firewall do VPS as portas **21** e **30000–30009**.
3. Redeploy com profile FTP ativo:
   ```bash
   docker compose --profile ftp up -d
   ```
   No Coolify, em **Docker Compose profiles**, adicione: `ftp`

### Conexão no FileZilla

| Campo | Valor |
|-------|--------|
| Host | IP público do servidor |
| Porta | `21` |
| Protocolo | FTP |
| Usuário | `giftmed` (ou `FTP_USER`) |
| Senha | `FTP_PASSWORD` |
| Modo | Passivo (PASV) |

### Pastas disponíveis via FTP

| Caminho FTP | Conteúdo |
|-------------|----------|
| `/wp-content/uploads/` | Imagens do WordPress |
| `/deploy/` | Coloque aqui `.sql` e depois importe pelo terminal MySQL |

> FTP envia dados sem criptografia. Use senha forte e desative o profile `ftp` quando não precisar mais.

## Importar site (All-in-One WP Migration)

Se aparecer **"Seu host restringe envios para 2 MB"**, o PHP do servidor ainda está com limite baixo. Após o deploy com `Dockerfile.wordpress`, o limite sobe para **512 MB**.

### Opção A — Enviar backup pelo FTP (recomendado para arquivos grandes)

1. Exporte o site local em **All-in-One WP Migration → Exportar** (gera um `.wpress`)
2. No FileZilla, conecte ao servidor (usuário `giftmed`, profile `ftp` ativo no Coolify)
3. Envie o arquivo para:
   ```
   /wp-content/ai1wm-backups/
   ```
4. No WordPress de produção: **All-in-One WP Migration → Backups**
5. Clique em **Restaurar** no arquivo enviado

> A opção **FTP** no menu "Importar a partir de" é extensão paga. O envio manual via FileZilla + menu **Backups** funciona na versão gratuita.

### Opção B — Arrastar e soltar (após corrigir limite PHP)

Após redeploy com a imagem customizada, a tela **Importar** deve mostrar **512 MB** em vez de 2 MB.

No Coolify, se o upload ainda falhar com arquivos muito grandes, aumente o timeout do proxy em **Server → Proxy → Configuration**:

```yaml
- '--entrypoints.https.transport.respondingTimeouts.readTimeout=600s'
```

## Deploy no Coolify (via GitHub)

Repositório: `https://github.com/fernandoifto/giftmed_wp`

### Configuração no Coolify

1. **Sources** → conecte o GitHub e autorize o repo `fernandoifto/giftmed_wp`
2. **+ New Resource → Docker Compose**
3. Preencha:
   - **Repository:** `fernandoifto/giftmed_wp`
   - **Branch:** `main`
   - **Base Directory:** `/`
   - **Docker Compose file:** `docker-compose.yaml`
4. No serviço **wordpress**, em **Domains**, adicione o domínio e ative HTTPS
5. Cole as variáveis de ambiente (seção abaixo)
6. **Deploy**

> O Coolify aceita `docker-compose.yaml` e `docker-compose.yml` — este projeto usa **`.yaml`**.

### Variáveis obrigatórias no Coolify

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

`WORDPRESS_PORT` é só para desenvolvimento local (`docker-compose.override.yaml`). **Não defina** `WORDPRESS_PORT` no Coolify — o proxy acessa o container pela rede interna na porta 80.

### Banco de dados

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

### Uploads (imagens)

Copie `wp-content/uploads/` do ambiente local para o volume/pasta de uploads no servidor. Sem isso, as imagens das notícias não aparecerão.

### Checklist pós-deploy

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
