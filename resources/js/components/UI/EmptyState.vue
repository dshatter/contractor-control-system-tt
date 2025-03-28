<script>
import ModalBtn from './ModalBtn.vue';

export default {
    name: 'EmptyState',
    components: { ModalBtn },
};
</script>

<template>

    <div class="empty-state" >
        <h3 class="empty-state__title">Контрагенты еще не добавлены</h3>
        <span class="empty-state__description mb-3">Добавьте первого контрагента</span>
        <ModalBtn ref="EmptyContentBtn" />
    </div>

</template>

<style scoped>

</style>
