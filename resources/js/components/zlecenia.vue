<template>
  <div class='text-center'>
      <h4>Lista zleceń</h4><br/>
      <input class="form-control" type="search" placeholder="Wyszukaj zlecenie ..." v-model="value">
      <table class="table table-bordered">
        <thead>
          <tr>
              <th>Dane Klienta</th>
              <th>Pracownik</th>
              <th>Urządzenie</th>
              <th>Usterka</th>
              <th>Uwaga</th>
              <th>Limit Kosztów</th>
          </tr>
        </thead>
        <tbody>
            <tr v-for="zlecenie in zlecenia" :key="zlecenie.id">
                <td>Edward tel:664038952</td>
                <td v-for="user in zlecenie.users" :key="user.id">{{user.imie}} {{user.nazwisko}}</td>
                <td>{{zlecenie.urzadzenie}}</td>
                <td>{{zlecenie.usterka}}</td>
                <td>{{zlecenie.uwaga}}</td>
                <td>{{zlecenie.limitkosztow}} zł</td>
                <td>
                <div class="btn-group" role="group">
                     <button class="btn btn-primary">Wykonane</button>
                </div>
                    <div class="btn-group" role="group">
                        <button @click="this.$router.push({name:'edytuj.zlecenia',params:{id: zlecenie.id}})" class="btn btn-danger">Edytuj</button>
                    </div>
                    <div class="btn-group" role="group">
                         <button @click="usunrekord(zlecenie.id)" class="btn btn-dark">Usuń</button>
                    </div>
                </td>
            </tr>
            </tbody>
      </table>
  </div>
  <div class="text-left">
    <button type="button" class="btn btn-success" @click="this.$router.push({name:'lista.dodawanie'})">Dodaj</button>
  </div>
</template>
<script>
export default {
    data() {
        return {
            zlecenia: [],
            value: null,
        }
    },
    created() {
    axios.get('/sanctum/csrf-cookie').then(response => {
      axios.get('api/zlecenia')
        .then(response => {
            this.zlecenia=response.data;
        })
        .catch(function (error) {
            console.error(error);
        });
        })
    },
    watch: {
    value(after, before){
    this.fetch();
    }
    },
    methods:{
    fetch(){
    axios.get('api/zs',{params: {value:this.value}})
      .then(response=>{
        this.zlecenia=response.data;
    })
    .catch(function (error) {
        console.error(error);
    });
    },
    usunrekord(id){
    axios.delete(`/api/usun/${id}`)
    .then(response => {
        let i = this.zlecenia.map(item => item.id).indexOf(id);
        this.books.splice(i, 1)
    })
    .catch(function (error) {
        console.error(error);
    });
    },
    }
}
</script>
