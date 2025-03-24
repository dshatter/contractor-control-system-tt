<script>
export default {
    name: 'Index',
    data() {
        return {
            data: null,
            innError: null,
            inputInn: null,
        };
    },

    methods: {
        getData() {
            axios
                .get('/api/contractors/show')
                .then(res => {
                    this.data = res.data.data;
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                });
        },
        addContractor() {
            console.log('addContractor');
            console.log(this.inputInn);
            axios
                .post('/api/contractors', { inn: this.inputInn })
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                });
        }

    },
    mounted() {
        this.getData();
    }
};

</script>
<template>
    <section class="content">           <!-- empty -->
        <div v-if="!data" class="empty-state" >
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
                <input type="text" class="form-control" placeholder="Поиск по ИНН / наименованию" aria-label="Search">
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
                    <tbody v-for="contractor in data">
                        <tr>
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
                    <li class="page-item disabled"><a class="page-link" href="#">Назад</a></li>
                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><span class="page-link">...</span></li>
                    <li class="page-item"><a class="page-link" href="#">Далее</a></li>
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
