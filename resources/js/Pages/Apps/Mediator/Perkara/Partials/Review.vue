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
    <tbody>
        <tr>
            <td>
                <p><b>Rating :</b> {{ props.data.rating }} dari 5</p>
                <p><b>Testimony :</b> {{ props.data.testimony }}</p>
            </td>
        </tr>
    </tbody>
</table>
</template>