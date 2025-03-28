<script>
import { Modal } from 'bootstrap';
import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'Modal',
    data() {
        return {
            modal: null,
            inn: {
                input: null,
                error: null
            },
        }
    },
    methods: {
        ...mapActions('modal',{
            open: 'open',
            close: 'close',
        }),
        addContractor() {
            axios
                .post('/api/contractors', { inn: this.inn.input })
                .then(res => {
                    this.inn.error = null;
                    this.inn.input = null;

                    this.$store.dispatch('contractors/getData');
                    this.close();
                })
                .catch((err) => {
                    this.inn.error = err.response.data.message;
                });
        },

    },
    watch: {
        opened(after, before) {
            if(!!after) {
                this.modal.show();
            } else {
                this.modal.hide();
            }
        }
    },
    computed:{
        ...mapGetters(
            'modal',
            {
                opened: 'opened'
            }
        ),
    },
    mounted() {
        this.modal = new Modal(this.$refs.ModalEl);
    }

}

</script>

<template>

    <Teleport to="body">
        <div ref="ModalEl" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow">
                    <div class="modal-body">
                        <h3 class="modal-title mb-2" id="exampleModalLabel">Добавление контрагента</h3>
                        <p>Введите ИНН, чтобы добавить контрагента</p>
                        <button @click="close" type="button" class="btn-close" aria-label="Close"></button>
                        <form>
                            <div class="my-3">
                                <input type="text" v-model="inn.input" class="form-control mb-2" :class="{ 'is-invalid': !!inn.error }" maxlength="10" name="inn" placeholder="ИНН">
                                <div v-if="inn.error" class="invalid-feedback">
                                    {{ inn.error }}
                                </div>
                                <p>После нажатия на кнопку «Добавить», данные автоматически подгрузятся в
                                    таблицу</p>
                            </div>
                            <button @click.prevent="addContractor" type="submit" class="btn btn-primary">Добавить
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </Teleport>

</template>

<style scoped>

</style>
