#!/usr/bin/env node
import 'dotenv/config';
import { Command } from 'commander';
import { FacebookClient } from './facebook.js';

const fb = new FacebookClient(process.env.FACEBOOK_ACCESS_TOKEN);
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
    const data = await fb.getMe(opts.fields);
    console.log(JSON.stringify(data, null, 2));
  });

// pages
program
  .command('pages')
  .description('Lista páginas gerenciadas pela conta')
  .action(async () => {
    const data = await fb.getMyPages();
    console.log(JSON.stringify(data, null, 2));
  });

// page-info
program
  .command('page-info <pageId>')
  .description('Exibe detalhes de uma página')
  .action(async (pageId) => {
    const data = await fb.getPage(pageId);
    console.log(JSON.stringify(data, null, 2));
  });

// posts
program
  .command('posts <targetId>')
  .description('Lista posts de um perfil ou página')
  .option('-l, --limit <n>', 'Número de posts', '10')
  .action(async (targetId, opts) => {
    const data = await fb.getPosts(targetId, parseInt(opts.limit));
    console.log(JSON.stringify(data, null, 2));
  });

// post
program
  .command('post <targetId> <message>')
  .description('Cria um post em um perfil ou página')
  .action(async (targetId, message) => {
    const data = await fb.createPost(targetId, message);
    console.log('Post criado:', JSON.stringify(data, null, 2));
  });

// delete-post
program
  .command('delete-post <postId>')
  .description('Deleta um post pelo ID')
  .action(async (postId) => {
    const data = await fb.deletePost(postId);
    console.log('Deletado:', data);
  });

// upload-photo
program
  .command('upload-photo <targetId> <imageUrl>')
  .description('Faz upload de foto via URL em uma página ou perfil')
  .option('-c, --caption <text>', 'Legenda da foto', '')
  .action(async (targetId, imageUrl, opts) => {
    const data = await fb.uploadPhoto(targetId, imageUrl, opts.caption);
    console.log('Foto enviada:', JSON.stringify(data, null, 2));
  });

// insights
program
  .command('insights <pageId>')
  .description('Exibe métricas/insights de uma página')
  .option('-m, --metric <metrics>', 'Métricas separadas por vírgula', 'page_impressions,page_engaged_users,page_fans')
  .option('-p, --period <period>', 'Período (day/week/month)', 'day')
  .action(async (pageId, opts) => {
    const data = await fb.getInsights(pageId, opts.metric, opts.period);
    console.log(JSON.stringify(data, null, 2));
  });

// comments
program
  .command('comments <objectId>')
  .description('Lista comentários de um post ou objeto')
  .option('-l, --limit <n>', 'Número de comentários', '20')
  .action(async (objectId, opts) => {
    const data = await fb.getComments(objectId, parseInt(opts.limit));
    console.log(JSON.stringify(data, null, 2));
  });

// reply
program
  .command('reply <commentId> <message>')
  .description('Responde a um comentário')
  .action(async (commentId, message) => {
    const data = await fb.replyToComment(commentId, message);
    console.log('Resposta enviada:', JSON.stringify(data, null, 2));
  });

// like
program
  .command('like <objectId>')
  .description('Curte um objeto (post, foto, etc.)')
  .action(async (objectId) => {
    const data = await fb.likeObject(objectId);
    console.log('Curtido:', data);
  });

// send-message
program
  .command('send-message <pageId> <recipientId> <message>')
  .description('Envia mensagem para um usuário via página (requer permissão pages_messaging)')
  .action(async (pageId, recipientId, message) => {
    const data = await fb.sendMessage(pageId, recipientId, message);
    console.log('Mensagem enviada:', JSON.stringify(data, null, 2));
  });

program.parseAsync(process.argv).catch(err => {
  const msg = err.response?.data?.error?.message || err.message;
  console.error('Erro:', msg);
  process.exit(1);
});
