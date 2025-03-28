<script>
import { mapGetters } from 'vuex';
export default {
    name: 'Pagination',
    methods: {
        checkPage(target, active, total) {
            target = Number(target);
            active = Number(active);
            total = Number(total);
            return target &&
                ((active - target) < 2 && (active - target) > -2) ||
                (target === 1 || target === total)
        },
        checkThreeDots(target, active, total) {
            target = Number(target);
            active = Number(active);
            total = Number(total);
            return target &&
                ((active - target) === 2) || ((active - target) === -2) &&
                ((target !== 1) && (target !== total));
        },
        setPage(number) {
            this.params.page = number;
        }
    },
    watch: {
        'params.page'(after, before) {
            this.$store.dispatch('contractors/getData');
        }
    },
    computed: {
        ...mapGetters('contractors',{
            params: 'params',
            meta: 'pagination'
        }),
    },
};
</script>

<template>
    <nav v-if="meta">
        <ul class="pagination mt-3">
            <li :class="{ 'page-item': true, 'disabled': (Number(meta.current_page) === 1) }">
                <button @click="setPage(meta.current_page - 1)" class="page-link">
                    Назад
                </button>
            </li>
            <template v-for="link in meta.links">
                <li class="page-item" v-if="checkPage(link.label, meta.current_page, meta.last_page)">
                    <a @click="setPage(link.label)" :class="{ 'page-link': true, 'active': link.active }" href="#">
                        {{ link.label }}
                    </a>
                </li>
                <li v-else-if="checkThreeDots(link.label, meta.current_page, meta.last_page)" class="page-item">
                    <span class="page-link">
                        ...
                    </span>
                </li>
            </template>
            <li :class="{ 'page-item': true, 'disabled': (Number(meta.current_page) === meta.last_page) }">
                <button @click="setPage(meta.current_page + 1)" class="page-link">
                    Далее
                </button>
            </li>
        </ul>
    </nav>
</template>

<style scoped>

</style>
