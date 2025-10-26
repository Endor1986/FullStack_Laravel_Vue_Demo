<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { useCourses } from '@/stores/courses';

const store = useCourses();
const q = ref('');

onMounted(() => store.fetch());

async function search() {
  await store.fetch(q.value);
}
</script>

<template>
  <div style="margin-top:1rem;">
    <input v-model="q" placeholder="Suche Titel..." />
    <button @click="search">Suchen</button>

    <div v-if="store.loading">Lade…</div>
    <div v-else-if="store.error" style="color:red">{{ store.error }}</div>

    <ul v-else>
      <li v-for="c in store.items" :key="c.id" style="display:flex; gap:.5rem; align-items:center;">
        <strong>{{ c.title }}</strong>
        <small>· {{ new Date(c.starts_at).toLocaleString() }}</small>
        <small>· {{ (c.price_cents/100).toFixed(2) }} €</small>
        <small>· {{ c.is_active ? 'aktiv' : 'inaktiv' }}</small>
        <button @click="store.remove(c.id!)">Löschen</button>
      </li>
    </ul>
  </div>
</template>
