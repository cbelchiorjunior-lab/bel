#!/usr/bin/env node
import 'dotenv/config';
import { Command } from 'commander';
import { FacebookClient } from './facebook.js';
import { WordPressClient } from './wordpress.js';

function makeWp() {
  return new WordPressClient(
    process.env.WP_SITE_URL,
    process.env.WP_USERNAME,
    process.env.WP_APP_PASSWORD,
  );
}

function makeFb() {
  return new FacebookClient(process.env.FACEBOOK_ACCESS_TOKEN);
}

const program = new Command();

program
  .name('bel-fb')
  .description('CLI para gerenciar conta Facebook/Meta via Graph API')
  .version('1.0.0');

// me
program
  .command('me')
  .description('Exibe informações do perfil')
  .option('-f, --fields <fields>', 'Campos a retornar', 'id,name,email,picture')
  .action(async (opts) => {
    const data = await makeFb().getMe(opts.fields);
    console.log(JSON.stringify(data, null, 2));
  });

// pages
program
  .command('pages')
  .description('Lista páginas gerenciadas pela conta')
  .action(async () => {
    const data = await makeFb().getMyPages();
    console.log(JSON.stringify(data, null, 2));
  });

// page-info
program
  .command('page-info <pageId>')
  .description('Exibe detalhes de uma página')
  .action(async (pageId) => {
    const data = await makeFb().getPage(pageId);
    console.log(JSON.stringify(data, null, 2));
  });

// posts
program
  .command('posts <targetId>')
  .description('Lista posts de um perfil ou página')
  .option('-l, --limit <n>', 'Número de posts', '10')
  .action(async (targetId, opts) => {
    const data = await makeFb().getPosts(targetId, parseInt(opts.limit));
    console.log(JSON.stringify(data, null, 2));
  });

// post
program
  .command('post <targetId> <message>')
  .description('Cria um post em um perfil ou página')
  .action(async (targetId, message) => {
    const data = await makeFb().createPost(targetId, message);
    console.log('Post criado:', JSON.stringify(data, null, 2));
  });

// delete-post
program
  .command('delete-post <postId>')
  .description('Deleta um post pelo ID')
  .action(async (postId) => {
    const data = await makeFb().deletePost(postId);
    console.log('Deletado:', data);
  });

// upload-photo
program
  .command('upload-photo <targetId> <imageUrl>')
  .description('Faz upload de foto via URL em uma página ou perfil')
  .option('-c, --caption <text>', 'Legenda da foto', '')
  .action(async (targetId, imageUrl, opts) => {
    const data = await makeFb().uploadPhoto(targetId, imageUrl, opts.caption);
    console.log('Foto enviada:', JSON.stringify(data, null, 2));
  });

// insights
program
  .command('insights <pageId>')
  .description('Exibe métricas/insights de uma página')
  .option('-m, --metric <metrics>', 'Métricas separadas por vírgula', 'page_impressions,page_engaged_users,page_fans')
  .option('-p, --period <period>', 'Período (day/week/month)', 'day')
  .action(async (pageId, opts) => {
    const data = await makeFb().getInsights(pageId, opts.metric, opts.period);
    console.log(JSON.stringify(data, null, 2));
  });

// comments
program
  .command('comments <objectId>')
  .description('Lista comentários de um post ou objeto')
  .option('-l, --limit <n>', 'Número de comentários', '20')
  .action(async (objectId, opts) => {
    const data = await makeFb().getComments(objectId, parseInt(opts.limit));
    console.log(JSON.stringify(data, null, 2));
  });

// reply
program
  .command('reply <commentId> <message>')
  .description('Responde a um comentário')
  .action(async (commentId, message) => {
    const data = await makeFb().replyToComment(commentId, message);
    console.log('Resposta enviada:', JSON.stringify(data, null, 2));
  });

// like
program
  .command('like <objectId>')
  .description('Curte um objeto (post, foto, etc.)')
  .action(async (objectId) => {
    const data = await makeFb().likeObject(objectId);
    console.log('Curtido:', data);
  });

// send-message
program
  .command('send-message <pageId> <recipientId> <message>')
  .description('Envia mensagem para um usuário via página (requer permissão pages_messaging)')
  .action(async (pageId, recipientId, message) => {
    const data = await makeFb().sendMessage(pageId, recipientId, message);
    console.log('Mensagem enviada:', JSON.stringify(data, null, 2));
  });

// ─── WordPress / SEO ───────────────────────────────────────────────────────

// wp-posts
program
  .command('wp-posts')
  .description('Lista posts do WordPress')
  .option('-n, --limit <n>', 'Número de posts', '10')
  .option('-s, --search <text>', 'Filtrar por texto')
  .option('--status <status>', 'Status dos posts (publish/draft/any)', 'publish')
  .action(async (opts) => {
    const wp = makeWp();
    const params = { per_page: parseInt(opts.limit), status: opts.status };
    if (opts.search) params.search = opts.search;
    const posts = await wp.getPosts(params);
    const rows = posts.map(p => ({ id: p.id, title: p.title?.rendered, status: p.status, link: p.link }));
    console.table(rows);
  });

// wp-seo-get
program
  .command('wp-seo-get <postId>')
  .description('Exibe os campos SEO (Rank Math) de um post')
  .action(async (postId) => {
    const wp = makeWp();
    const data = await wp.getSeo(postId);
    console.log(JSON.stringify(data, null, 2));
  });

// wp-seo-update
program
  .command('wp-seo-update <postId>')
  .description('Atualiza campos SEO (Rank Math) de um post')
  .option('-t, --seo-title <title>', 'Título SEO (rank_math_title)')
  .option('-d, --meta-desc <desc>', 'Meta descrição (rank_math_description)')
  .option('-k, --keyword <kw>', 'Palavra-chave foco (rank_math_focus_keyword)')
  .action(async (postId, opts) => {
    const wp = makeWp();
    const data = await wp.updateSeo(postId, {
      seoTitle: opts.seoTitle,
      metaDescription: opts.metaDesc,
      focusKeyword: opts.keyword,
    });
    console.log('SEO atualizado:', JSON.stringify(data, null, 2));
  });

program.parseAsync(process.argv).catch(err => {
  const msg = err.response?.data?.error?.message || err.message;
  console.error('Erro:', msg);
  process.exit(1);
});
