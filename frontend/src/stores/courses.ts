import { defineStore } from 'pinia';
import http from '@/api/http';

export interface Course {
  id?: number;
  title: string;
  description?: string | null;
  starts_at: string; // ISO
  price_cents: number;
  is_active: boolean;
  created_at?: string;
  updated_at?: string;
}

export const useCourses = defineStore('courses', {
  state: () => ({
    items: [] as Course[],
    loading: false,
    error: null as string | null
  }),
  actions: {
    async fetch(q = '') {
      this.loading = true; this.error = null;
      try {
        const { data } = await http.get('/courses', { params: { q } });
        this.items = data.data ?? data;
      } catch (e: any) {
        this.error = e?.message ?? 'Fehler beim Laden';
      } finally {
        this.loading = false;
      }
    },
    async create(payload: Course) {
      await http.post('/courses', payload);
      await this.fetch();
    },
    async remove(id: number) {
      await http.delete(`/courses/${id}`);
      await this.fetch();
    }
  }
});
