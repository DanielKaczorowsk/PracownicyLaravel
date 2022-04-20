<template>
<div>
        <h4 class="text-center">Dodaj Zlecenie</h4>
        <div class="row justify-content-center">
            <div class="col-md-6">
            <form @submit.prevent="dodajzlecenie">
                <div class="form-group p-1">
                    <label for="exampleFormControlInput1">Urządzenie</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Wpisz tu urządzenie i model" v-model="zlecenia.urzadzenie">
                </div>
                <div class="form-group p-1">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select class="form-control" v-model="zlecenia.userid" id="exampleFormControlSelect1">
                      <option v-for="user in users" :key="user.id" :value="user.id">{{user.imie}} {{user.nazwisko}}</option>
                    </select>
               </div>
               <div class="form-group p-1">
                    <label for="exampleFormControlTextarea1">Usterka</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" v-model="zlecenia.usterka" rows="3"></textarea>
               </div>
               <div class="form-group p-1">
                    <label for="exampleFormControlTextarea1">Uwaga</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" v-model="zlecenia.uwaga" rows="3"></textarea>
                </div>
                <div class="form-group p-1">
                    <label for="exampleFormControlInput1">Limit Kosztów</label>
                    <input type=number step=0.01 class="form-control"  v-model="zlecenia.limitkosztow" id="exampleFormControlInput1">
                </div>
                <div class="btn-group p-1" role="group">
                    <button class="btn btn-dark">Dodaj Zlecenie</button>
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
            users: [],
            zlecenia: {}
        }
    },
    created() {
    axios.get('/sanctum/csrf-cookie').then(response => {
      axios.get('api/getdod')
        .then(response => {
            this.users=response.data;
        })
        .catch(function (error) {
            console.error(error);
        });
    })
    },
    methods:{
    dodajzlecenie(){
    axios.get('/sanctum/csrf-cookie').then(response => {
    axios.post('api/dodawanie',this.zlecenia)
    .then(response=>{
    this.$router.push({name:'zlecenia'})
    })
    })
    }
    }
}
</script>
