import axios from 'axios';

export class WordPressClient {
  constructor(siteUrl, username, password) {
    if (!siteUrl || !username || !password) {
      throw new Error('WP_SITE_URL, WP_USERNAME e WP_PASSWORD são obrigatórios');
    }
    this.base = siteUrl.replace(/\/$/, '');
    this.username = username;
    this.password = password;
    this.token = null;
    this.http = axios.create({ baseURL: `${this.base}/wp-json/wp/v2` });
  }

  // --- Autenticação JWT ---

  async login() {
    const res = await axios.post(`${this.base}/wp-json/jwt-auth/v1/token`, {
      username: this.username,
      password: this.password,
    });
    this.token = res.data.token;
    this.http.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
    return this.token;
  }

  async ensureAuth() {
    if (!this.token) await this.login();
  }

  // --- Posts ---

  async getPosts(params = {}) {
    await this.ensureAuth();
    const res = await this.http.get('/posts', {
      params: { per_page: 10, context: 'edit', ...params },
    });
    return res.data;
  }

  async getPost(postId) {
    await this.ensureAuth();
    const res = await this.http.get(`/posts/${postId}`, {
      params: { context: 'edit' },
    });
    return res.data;
  }

  // --- Rank Math SEO ---

  async updateSeo(postId, { seoTitle, metaDescription, focusKeyword } = {}) {
    await this.ensureAuth();
    const meta = {};
    if (seoTitle !== undefined)        meta.rank_math_title = seoTitle;
    if (metaDescription !== undefined) meta.rank_math_description = metaDescription;
    if (focusKeyword !== undefined)    meta.rank_math_focus_keyword = focusKeyword;

    if (Object.keys(meta).length === 0) {
      throw new Error('Informe pelo menos um campo SEO: --seo-title, --meta-desc ou --keyword');
    }

    const res = await this.http.post(`/posts/${postId}`, { meta });
    return {
      id: res.data.id,
      title: res.data.title?.rendered,
      link: res.data.link,
      seo: {
        rank_math_title: res.data.meta?.rank_math_title,
        rank_math_description: res.data.meta?.rank_math_description,
        rank_math_focus_keyword: res.data.meta?.rank_math_focus_keyword,
      },
    };
  }

  async getSeo(postId) {
    const post = await this.getPost(postId);
    return {
      id: post.id,
      title: post.title?.rendered,
      link: post.link,
      seo: {
        rank_math_title: post.meta?.rank_math_title ?? null,
        rank_math_description: post.meta?.rank_math_description ?? null,
        rank_math_focus_keyword: post.meta?.rank_math_focus_keyword ?? null,
      },
    };
  }
}
