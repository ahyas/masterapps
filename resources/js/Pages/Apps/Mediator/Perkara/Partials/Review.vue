<script setup>
const props = defineProps({
    data:{
        type:Object
    }
});
console.log('embuh ',props.data.reviews)
</script>

<template>

<table v-if="$page.props.auth.can.menilai_mediator">
    <tr>
        <td colspan="3">
            <p class="mb-1 mt-4"><u>Review Anda :</u></p>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <p><b>Rating :</b> {{ props.data.rating }} dari 5</p>
            <p><b>Testimony :</b> {{ props.data.testimony }}</p>
        </td>
    </tr>
</table>
</template>