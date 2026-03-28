import axios from 'axios';

const BASE_URL = 'https://graph.facebook.com/v19.0';

export class FacebookClient {
  constructor(accessToken) {
    if (!accessToken) {
      throw new Error('FACEBOOK_ACCESS_TOKEN é obrigatório');
    }
    this.token = accessToken;
    this.http = axios.create({ baseURL: BASE_URL });
  }

  // --- Conta / Perfil ---

  async getMe(fields = 'id,name,email,picture') {
    const res = await this.http.get('/me', {
      params: { fields, access_token: this.token },
    });
    return res.data;
  }

  // --- Páginas ---

  async getMyPages() {
    const res = await this.http.get('/me/accounts', {
      params: { access_token: this.token },
    });
    return res.data;
  }

  async getPage(pageId, fields = 'id,name,fan_count,followers_count,about,website') {
    const res = await this.http.get(`/${pageId}`, {
      params: { fields, access_token: this.token },
    });
    return res.data;
  }

  // --- Posts ---

  async getPosts(targetId, limit = 10) {
    const res = await this.http.get(`/${targetId}/feed`, {
      params: {
        fields: 'id,message,created_time,full_picture,permalink_url',
        limit,
        access_token: this.token,
      },
    });
    return res.data;
  }

  async createPost(targetId, message, options = {}) {
    const payload = {
      message,
      access_token: this.token,
      ...options,
    };
    const res = await this.http.post(`/${targetId}/feed`, payload);
    return res.data;
  }

  async deletePost(postId) {
    const res = await this.http.delete(`/${postId}`, {
      params: { access_token: this.token },
    });
    return res.data;
  }

  // --- Fotos ---

  async uploadPhoto(targetId, imageUrl, caption = '') {
    const res = await this.http.post(`/${targetId}/photos`, {
      url: imageUrl,
      caption,
      access_token: this.token,
    });
    return res.data;
  }

  // --- Insights (apenas para páginas) ---

  async getInsights(pageId, metric = 'page_impressions,page_engaged_users,page_fans', period = 'day') {
    const res = await this.http.get(`/${pageId}/insights`, {
      params: {
        metric,
        period,
        access_token: this.token,
      },
    });
    return res.data;
  }

  // --- Comentários ---

  async getComments(objectId, limit = 20) {
    const res = await this.http.get(`/${objectId}/comments`, {
      params: {
        fields: 'id,message,from,created_time',
        limit,
        access_token: this.token,
      },
    });
    return res.data;
  }

  async replyToComment(commentId, message) {
    const res = await this.http.post(`/${commentId}/comments`, {
      message,
      access_token: this.token,
    });
    return res.data;
  }

  // --- Likes ---

  async likeObject(objectId) {
    const res = await this.http.post(`/${objectId}/likes`, {
      access_token: this.token,
    });
    return res.data;
  }

  // --- Mensagens (apenas páginas com permissão pages_messaging) ---

  async sendMessage(pageId, recipientId, messageText) {
    const res = await this.http.post(`/${pageId}/messages`, {
      recipient: { id: recipientId },
      message: { text: messageText },
      access_token: this.token,
    });
    return res.data;
  }
}
