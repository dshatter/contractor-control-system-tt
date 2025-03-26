<script>
export default {
    name: 'Index',
    data() {
        return {
            data: [],
            innError: null,
            inputInn: null,
            paginationMeta: null,
            getParams: {
                page: 1,
                search: ''
            }
        };
    },

    watch: {
        'getParams.page'(after, before) {
            this.getData();
        },
        'getParams.search'(after, before) {
            this.getData();
        }
    },
    computed: {
        emptyData() {
            return !this.data || this.data.length === 0;
        }
    },

    methods: {
        getData() {
            axios
                .get('/api/contractors', {params: this.getParams})
                .then(res => {
                    this.data = res.data.data;
                    this.paginationMeta = res.data.meta;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        addContractor() {
            axios
                .post('/api/contractors', { inn: this.inputInn })
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                });
        },
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
            this.getParams.page = number;
        }

    },
    mounted() {
        this.getData();
    }
};

</script>
<template>
    <section class="content">
        <div v-if="emptyData" class="empty-state" >
            <h3 class="empty-state__title">Контрагенты еще не добавлены</h3>
            <span class="empty-state__description mb-3">Добавьте первого контрагента</span>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContractor">Добавить</button>
        </div>
        <div v-else>
            <div class="header-container mb-4">
                <h1>Добавленные контрагенты</h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContractor">Добавить</button>
            </div>
            <div class="input-search-wrap mb-3 w-100">
                <span class="input-search-icon"></span>
                <input v-model="getParams.search" type="text" class="form-control" placeholder="Поиск по ИНН / наименованию" aria-label="Search">
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ИНН</th>
                        <th>Наименование</th>
                        <th>ОГРН</th>
                        <th>Адрес</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="contractor in data">
                            <td>{{ contractor.inn }}</td>
                            <td>{{ contractor.name }}</td>
                            <td>{{ contractor.ogrn }}</td>
                            <td>{{ contractor.address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination mt-3">
                    <li :class="{ 'page-item': true, 'disabled': (Number(paginationMeta.current_page) === 1) }">
                        <button @click="setPage(paginationMeta.current_page - 1)" class="page-link">
                            Назад
                        </button>
                    </li>
                    <template v-for="link in paginationMeta.links">
                        <li class="page-item" v-if="checkPage(link.label, paginationMeta.current_page, paginationMeta.last_page)">
                            <a @click="setPage(link.label)" :class="{ 'page-link': true, 'active': link.active }" href="#">
                                {{ link.label }}
                            </a>
                        </li>
                        <li v-else-if="checkThreeDots(link.label, paginationMeta.current_page, paginationMeta.last_page)" class="page-item">
                            <span class="page-link">
                                ...
                            </span>
                        </li>
                    </template>
                    <li :class="{ 'page-item': true, 'disabled': (Number(paginationMeta.current_page) === paginationMeta.last_page) }">
                        <button @click="setPage(paginationMeta.current_page + 1)" class="page-link">
                            Далее
                        </button>
                    </li>
                </ul>
            </nav>

        </div>

    </section>

    <div class="modal fade" data-bs-backdrop="static" id="addContractor" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-body">
                    <h3 class="modal-title mb-2" id="exampleModalLabel">Добавление контрагента</h3>
                    <p>Введите ИНН, чтобы добавить контрагента</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form>
                        <div class="my-3">
                            <input type="text" v-model="inputInn" class="form-control mb-2" maxlength="10" name="inn" placeholder="ИНН">
                            <div v-if="innError" class="invalid-feedback">
                                {{ innError }}
                            </div>
                            <p>После нажатия на кнопку «Добавить», данные автоматически подгрузятся в таблицу</p>
                        </div>
                        <button @click.prevent="addContractor" type="submit" class="btn btn-primary">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
