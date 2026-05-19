<script setup>
const props = defineProps({
    review:{
        type:Object
    }
});
console.log('rata-rata ', props.review)
const total = props.review.reduce((sum, review) => sum + review.rating, 0);
const averageGrade = total / props.review.length;
console.log('Score ', averageGrade);
</script>

<template>
    <div :class="averageGrade <= 3 ? 'p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400' : 'p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400'" role="alert">
        <h1 v-if="props.review.length" class=" text-lg">Rating para Pihak: <b>{{ averageGrade.toFixed(2) }} dari 5</b></h1>
        <h1 v-else>Belum ada penilaian</h1>
    </div>
</template>