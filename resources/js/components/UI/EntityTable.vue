<script>
import ModalBtn from './ModalBtn.vue';
import Pagination from './Pagination.vue';
import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'EntityTable',
    components: { Pagination, ModalBtn },
    watch: {
        'params.search'(after, before) {
            this.$store.dispatch('contractors/getData');
        }
    },
    computed: {
        ...mapGetters('contractors', {
            params: 'params',
            contractors: 'contractors'
        }),
        notFound() {
            return !!(this.$store.getters['contractors/config'].status === 404);
        }
    },
};
</script>

<template>
    <div>
        <div class="header-container mb-4">
            <h1>Добавленные контрагенты</h1>
            <ModalBtn ref="ExistingContentBtn" />
        </div>
        <div class="input-search-wrap mb-3 w-100">
            <span class="input-search-icon"></span>
            <input v-model="params.search" type="text" class="form-control" placeholder="Поиск по ИНН / наименованию" aria-label="Search">
        </div>
        <template v-if="contractors && !notFound">
            <div class="table-responsive">
                <table class="table" >
                    <thead>
                    <tr>
                        <th>ИНН</th>
                        <th>Наименование</th>
                        <th>ОГРН</th>
                        <th>Адрес</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="contractor in contractors">
                        <td>{{ contractor.inn }}</td>
                        <td>{{ contractor.name }}</td>
                        <td>{{ contractor.ogrn }}</td>
                        <td>{{ contractor.address }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <Pagination ref="pagination" />
        </template>
        <span v-else>По данному запросу ничего не найдено</span>
    </div>
</template>

<style scoped>

</style>
