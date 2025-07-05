<template>
  <div class="p-4 max-w-md mx-auto">
    <h1 class="text-xl font-bold mb-4">Card Distributor</h1>

    <form @submit.prevent="submitForm" class="space-y-4">
      <div>
        <label for="people" class="block text-sm font-medium">Number of People:</label>
        <input
          v-model="people"
          type="number"
          id="people"
          class="w-full border p-2 rounded"
          placeholder="Enter a number (e.g. 4)"
        />
      </div>

      <div v-if="error" class="text-red-500 text-sm">
        {{ error }}
      </div>

      <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        :disabled="loading"
      >
        {{ loading ? 'Distributing...' : 'Distribute Cards' }}
      </button>
    </form>

    <div v-if="cards.length" class="mt-6">
      <h2 class="text-lg font-semibold mb-2">Result:</h2>
      <div class="space-y-2">
        <div
          v-for="(line, index) in cards"
          :key="index"
          class="font-mono bg-gray-100 p-2 rounded"
        >
          {{ line }}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const people = ref('')
const cards = ref([])
const error = ref('')
const loading = ref(false)

const submitForm = async () => {
  error.value = ''
  cards.value = []

  const n = parseInt(people.value)

  if (isNaN(n) || n <= 0) {
    error.value = 'Please enter a valid number greater than 0.'
    return
  }

  loading.value = true

  try {
    const response = await axios.post('/api/cards', {
      people: n
    })
    cards.value = response.data.output
  }
  catch (err) {
    // error.value = err.response?.data?.message || 'Unexpected error occurred.'
    error.value = err.response?.data?.message || 'Irregularity occurred.'
  }
  finally {
    loading.value = false
  }
}
</script>

<style scoped>
input:focus {
  outline: none;
  border-color: #2563eb;
  box-shadow: 0 0 0 1px #2563eb;
}
</style>
