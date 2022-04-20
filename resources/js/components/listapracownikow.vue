<template>
  <div class='text-center'>
      <h4>Lista Pracowników</h4><br/>
      <input class="form-control" type="search" placeholder="Wyszukaj zlecenie ..." v-model="value">
      <table class="table table-bordered">
        <thead>
          <tr>
              <th>Imie</th>
              <th>Nazwisko</th>
              <th>Rola</th>
          </tr>
        </thead>
        <tbody>
            <tr v-for="dane in danes" :key="dane.id">
                <td v-for="user in dane.users" :key="user.id">{{user.imie}}</td>
                <td v-for="user in dane.users" :key="user.id">{{user.nazwisko}}</td>
                <td>{{dane.slug}}</td>
            </tr>
            </tbody>
      </table>
      <button class='btn btn-dark' @click="this.$router.push({name:'pracownicy.role'})">Nadaj Role</button>
  </div>
</template>
<script>
export default {
    data() {
        return {
            danes: [],
            value: null,
        }
    },
    created() {
    axios.get('/sanctum/csrf-cookie').then(response => {
    axios.get('api/show')
      .then(response => {
          this.danes=response.data;
          console.log(response.data);
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
        axios.get('/sanctum/csrf-cookie').then(response => {
        axios.get('api/sru',{params: {value:this.value}})
          .then(response=>{
            this.danes=response.data;
            console.log(response.data);
            })
          .catch(function (error) {
            console.error(error);
          });
        })
        }
      }
}
</script>
