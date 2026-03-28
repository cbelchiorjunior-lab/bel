# Bel — Facebook/Meta Integration

Integração com a API Graph do Facebook/Meta para gerenciamento de conta, páginas e posts.

## Configuração

1. Instale as dependências:
   ```bash
   npm install
   ```

2. Copie o arquivo de exemplo e preencha com seu token:
   ```bash
   cp .env.example .env
   ```

3. Edite `.env` com seu token de acesso (obtenha em https://developers.facebook.com/tools/explorer/).

## Uso via CLI

```bash
# Informações do perfil
node src/cli.js me

# Listar páginas gerenciadas
node src/cli.js pages

# Detalhes de uma página
node src/cli.js page-info <PAGE_ID>

# Listar posts
node src/cli.js posts <PAGE_ID_OU_PERFIL_ID> --limit 5

# Criar post
node src/cli.js post <PAGE_ID> "Olá, mundo!"

# Deletar post
node src/cli.js delete-post <POST_ID>

# Upload de foto
node src/cli.js upload-photo <PAGE_ID> https://exemplo.com/foto.jpg --caption "Minha foto"

# Insights da página
node src/cli.js insights <PAGE_ID> --metric page_impressions,page_fans --period day

# Comentários de um post
node src/cli.js comments <POST_ID>

# Responder comentário
node src/cli.js reply <COMMENT_ID> "Obrigado!"

# Curtir objeto
node src/cli.js like <POST_ID>

# Enviar mensagem (requer permissão pages_messaging)
node src/cli.js send-message <PAGE_ID> <RECIPIENT_ID> "Olá!"
```

## Uso como módulo

```js
import { FacebookClient } from './src/facebook.js';

const fb = new FacebookClient(process.env.FACEBOOK_ACCESS_TOKEN);

const me = await fb.getMe();
const posts = await fb.getPosts('PAGE_ID', 10);
await fb.createPost('PAGE_ID', 'Novo post!');
```

## Segurança

- **Nunca** commite o arquivo `.env` com seu token real.
- Regenere tokens expostos imediatamente em https://developers.facebook.com/.
