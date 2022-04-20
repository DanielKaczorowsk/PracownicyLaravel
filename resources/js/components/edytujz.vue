<template>
<div>
        <h4 class="text-center">Edytuj zlecenie</h4>
        <div class="row justify-content-center">
            <div class="col-md-6">
            <form @submit.prevent="updatezlecenie">
                <div class="form-group p-1">
                    <label for="exampleFormControlInput1">Urządzenie</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" v-model="zlecenie.urzadzenie">
                </div>
               <div class="form-group p-1">
                    <label for="exampleFormControlTextarea1">Usterka</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" v-model="zlecenie.usterka" rows="3"></textarea>
               </div>
               <div class="form-group p-1">
                    <label for="exampleFormControlTextarea1">Uwaga</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" v-model="zlecenie.uwaga" rows="3"></textarea>
                </div>
                <div class="form-group p-1">
                    <label for="exampleFormControlInput1">Limit Kosztów</label>
                    <input type=number step=0.01 class="form-control"  v-model="zlecenie.limitkosztow" id="exampleFormControlInput1">
                </div>
                <div class="btn-group p-1" role="group">
                    <button class="btn btn-dark">Zmień dane</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            zlecenie: {}
        }
    },
    created() {
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.get(`/api/edytowanie/${this.$route.params.id}`)
                .then(response => {
                    this.zlecenie=response.data
                })
                .catch(function (error) {
                    console.error(error);
                });
                })
    },
    methods: {
        updatezlecenie() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post(`/api/update/${this.$route.params.id}`, this.zlecenie)
                    .then(response => {
                        this.$router.push({name: 'zlecenia'});
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
        })
        }
    }
    }
</script>
