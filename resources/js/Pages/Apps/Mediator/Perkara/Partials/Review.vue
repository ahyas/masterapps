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
    <thead>
    <tr>
        <td colspan="3">
            <p class="mb-1 mt-4 text-left"><u>Review Anda :</u></p>
        </td>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="3">
                <p><b>Rating :</b> {{ props.data.rating }} dari 5</p>
                <p><b>Testimony :</b> {{ props.data.testimony }}</p>
            </td>
        </tr>
    </tbody>
</table>
</template>