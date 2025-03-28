<script>
export default {
    name: 'ModalBtn',
    methods: {
        openModal() {
            this.$store.dispatch('modal/open');
        }
    }
}
</script>

<template>
    <button @click="openModal()" class="btn btn-primary" >Добавить</button>
</template>

<style scoped>

</style>
