import 'dotenv/config';
import { FacebookClient } from './facebook.js';

const token = process.env.FACEBOOK_ACCESS_TOKEN;
const pageId = process.env.FACEBOOK_PAGE_ID;

const fb = new FacebookClient(token);

// Exemplo de uso: exibe informações da conta e posts
async function main() {
  console.log('=== Informações da Conta ===');
  const me = await fb.getMe();
  console.log(me);

  console.log('\n=== Minhas Páginas ===');
  const pages = await fb.getMyPages();
  console.log(JSON.stringify(pages, null, 2));

  if (pageId) {
    console.log(`\n=== Posts da Página ${pageId} ===`);
    const posts = await fb.getPosts(pageId, 5);
    console.log(JSON.stringify(posts, null, 2));
  }
}

main().catch(err => {
  const msg = err.response?.data?.error?.message || err.message;
  console.error('Erro:', msg);
  process.exit(1);
});
