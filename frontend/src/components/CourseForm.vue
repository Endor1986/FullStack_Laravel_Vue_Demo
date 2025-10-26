<script setup lang="ts">
import { ref } from 'vue';
import { useCourses, type Course } from '@/stores/courses';

const store = useCourses();
const form = ref<Course>({
  title: '',
  description: '',
  starts_at: new Date().toISOString().slice(0,16),
  price_cents: 0,
  is_active: true
});

async function submit() {
  if (!form.value.title || !form.value.starts_at) {
    alert('Titel und Startdatum sind erforderlich.');
    return;
  }
  const payload = {
    ...form.value,
    starts_at: new Date(form.value.starts_at).toISOString(),
  };
  await store.create(payload);
  form.value = { title:'', description:'', starts_at:new Date().toISOString().slice(0,16), price_cents:0, is_active:true };
}
</script>

<template>
  <form @submit.prevent="submit" style="display:grid; gap:.5rem; max-width:420px;">
    <input v-model="form.title" placeholder="Titel" />
    <input v-model="form.starts_at" type="datetime-local" />
    <input v-model.number="form.price_cents" type="number" min="0" placeholder="Preis (Cent)" />
    <label><input type="checkbox" v-model="form.is_active" /> aktiv</label>
    <textarea v-model="form.description" placeholder="Beschreibung"></textarea>
    <button type="submit">Speichern</button>
  </form>
</template>
