import axios from 'axios';

const http = axios.create({
  baseURL: '/api',
  timeout: 10000,
});

http.interceptors.response.use(
  r => r,
  e => {
    const msg = e?.response?.data?.message || e.message || 'Fehler';
    console.error('[HTTP]', msg);
    return Promise.reject(e);
  }
);

export default http;
