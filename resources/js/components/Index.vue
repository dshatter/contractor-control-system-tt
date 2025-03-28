<script>
import Modal from './UI/Modal.vue';
import ModalBtn from './UI/ModalBtn.vue';
import EmptyState from './UI/EmptyState.vue';
import EntityTable from './UI/EntityTable.vue';
import { mapActions } from 'vuex';
export default {
    name: 'Index',
    components: {
        EntityTable,
        EmptyState,
        ModalBtn,
        Modal,
    },
    methods: {
        ...mapActions('contractors', {
            getData: 'getData'
        }),
    },
    mounted() {

        this.getData();
    },
    computed: {
        emptyUserContent() {
            return !!(this.$store.getters['contractors/config'].status === 204);
        }
    }
};

</script>
<template>
    <section class="content">

        <EmptyState ref="empty" v-if="emptyUserContent" />

        <EntityTable ref="content" v-else />

    </section>

    <Modal ref="InnModal" />
</template>

<style scoped>

</style>
