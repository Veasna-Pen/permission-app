<template>
    <nav class="pagination">
      <ul>
        <li v-if="pagination.prev">
          <Link :href="pagination.prev_url">Previous</Link>
        </li>
        <li v-else>Previous</li>

        <li v-for="(page, index) in pages" :key="index">
          <Link :href="page.url" :class="{ 'is-current': page.active }">
            {{ page.label }}
          </Link>
        </li>

        <li v-if="pagination.next">
          <Link :href="pagination.next_url">Next</Link>
        </li>
        <li v-else>Next</li>
      </ul>
    </nav>
  </template>

  <script setup>
import { Link } from '@inertiajs/vue3'

  const props = defineProps({
    pagination: {
      type: Object,
      required: true,
    },
  })

  const pages = pagination.links.map(link => ({
    url: link.url,
    label: link.label,
    active: link.active,
  }))
  </script>
