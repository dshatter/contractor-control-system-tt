<script>
export default {
    name: 'Index',
    data() {
        return {
            data: null,
        };
    },

    methods: {
        getData() {
            axios
                .get('/api/contractors/show')
                .then(res => {
                    this.data = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },
    },
    mounted() {
        this.getData();
    }
};

</script>
<template>
    <section class="content empty">           <!-- empty -->
        <div class="empty-state" v-if="data">
            <h3 class="empty-state__title">Контрагенты еще не добавлены</h3>
            <span class="empty-state__description mb-3">Добавьте первого контрагента</span>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContractor">Добавить</button>
        </div>

        <!--        <div class="header-container mb-4">-->
        <!--            <h1>Добавленные контрагенты</h1>-->
        <!--            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContractor">Добавить</button>-->
        <!--        </div>-->
        <!--        <div class="input-search-wrap mb-3 w-100">-->
        <!--            <span class="input-search-icon"></span>-->
        <!--            <input type="text" class="form-control" placeholder="Поиск по ИНН / наименованию" aria-label="Search">-->
        <!--        </div>-->
        <!--        <div class="table-responsive">-->
        <!--            <table class="table">-->
        <!--                <thead>-->
        <!--                <tr>-->
        <!--                    <th>ИНН</th>-->
        <!--                    <th>Наименование</th>-->
        <!--                    <th>ОГРН</th>-->
        <!--                    <th>Адрес</th>-->
        <!--                </tr>-->
        <!--                </thead>-->
        <!--                <tbody>-->
        <!--                <tr>-->
        <!--                    <td>7775014567</td>-->
        <!--                    <td>ООО "Лайн-Тек"</td>-->
        <!--                    <td>1027739164681</td>-->
        <!--                    <td>г. Москва, ул. Чистопрудный бульвар, д. 1</td>-->
        <!--                </tr>-->
        <!--                <tr>-->
        <!--                    <td>7801010018</td>-->
        <!--                    <td>АО "ТехноТек"</td>-->
        <!--                    <td>1027800008627</td>-->
        <!--                    <td>г. Санкт-Петербург, ул. Чехова, д. 5</td>-->
        <!--                </tr>-->
        <!--                <tr>-->
        <!--                    <td>1234567890</td>-->
        <!--                    <td>ООО "Тестовая Компания"</td>-->
        <!--                    <td>1234567890123</td>-->
        <!--                    <td>г. Тула, ул. Ленина, д. 15</td>-->
        <!--                </tr>-->
        <!--                <tr>-->
        <!--                    <td>9876543210</td>-->
        <!--                    <td>ЗАО "Другой Фирм"</td>-->
        <!--                    <td>9876543210987</td>-->
        <!--                    <td>г. Москва, ул. Мясницкая, д. 3</td>-->
        <!--                </tr>-->
        <!--                </tbody>-->
        <!--            </table>-->
        <!--        </div>-->
        <!--        <nav aria-label="Page navigation">-->
        <!--            <ul class="pagination mt-3">-->
        <!--                <li class="page-item disabled"><a class="page-link" href="#">Назад</a></li>-->
        <!--                <li class="page-item"><a class="page-link active" href="#">1</a></li>-->
        <!--                <li class="page-item"><a class="page-link" href="#">2</a></li>-->
        <!--                <li class="page-item"><span class="page-link">...</span></li>-->
        <!--                <li class="page-item"><a class="page-link" href="#">Далее</a></li>-->
        <!--            </ul>-->
        <!--        </nav>-->

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
                            <input type="text" class="form-control mb-2" name="inn" placeholder="ИНН">
                            <p>После нажатия на кнопку «Добавить», данные автоматически подгрузятся в таблицу</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
