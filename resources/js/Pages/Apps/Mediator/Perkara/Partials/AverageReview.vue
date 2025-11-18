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
    <div :class="props.averageGrade <= 3 ? 'p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400' : 'p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400'" role="alert">
        <h1 class=" text-lg">Nilai rata-rata Anda: <b>{{ averageGrade }} dari 5</b></h1>
    </div>
</template>