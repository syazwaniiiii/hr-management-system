<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

// Mock weekly schedule data
const weeklySchedule = ref([
  { day: 'Monday', shift: { name: 'Morning Shift', start_time: '08:00', end_time: '16:00' } },
  { day: 'Tuesday', shift: { name: 'Evening Shift', start_time: '14:00', end_time: '22:00' } },
  { day: 'Wednesday', shift: null },
  { day: 'Thursday', shift: { name: 'Night Shift', start_time: '22:00', end_time: '06:00' } },
  { day: 'Friday', shift: null },
  { day: 'Saturday', shift: { name: 'Morning Shift', start_time: '08:00', end_time: '16:00' } },
  { day: 'Sunday', shift: null },
]);
</script>

<template>
  <Head title="My Weekly Schedule" />
  <AuthenticatedLayout>
    <div class="py-8 bg-gray-50 min-h-screen">
      <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold mb-6 text-center text-gray-800">My Weekly Schedule</h1>
        <div class="bg-white shadow rounded-lg overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Day</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Shift</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Time</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
              <tr v-for="(entry, idx) in weeklySchedule" :key="entry.day" :class="idx % 2 === 0 ? 'bg-gray-50' : ''">
                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-gray-800">{{ entry.day }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span v-if="entry.shift" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                    {{ entry.shift.name }}
                  </span>
                  <span v-else class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-200 text-gray-500">
                    No Shift Assigned
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                  <span v-if="entry.shift">
                    {{ entry.shift.start_time }} - {{ entry.shift.end_time }}
                  </span>
                  <span v-else>-</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="mt-8 text-center text-gray-500 text-sm">
          <span class="italic">Contact your manager if you have questions about your schedule.</span>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>