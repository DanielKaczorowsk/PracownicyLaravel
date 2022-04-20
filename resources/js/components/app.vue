<template>
<div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div v-if="zalogowany" class="navbar-nav">
                  <router-link v-if="role === 'Administrator'" to="/admin" class="nav-item nav-link">{{user}}</router-link>
                  <router-link v-if="role === 'Kierownik'" to="/kierownik" class="nav-item nav-link">{{user}}</router-link>
                  <router-link v-if="role === 'Pracownik'" to="/dashboard/pracownik" class="nav-item nav-link">{{user}}</router-link>
                  <router-link v-if="role === 'Kilent'" to="/klient" class="nav-item nav-link">{{user}}</router-link>
                  <a class="nav-item nav-link" style="cursor: pointer;" @click="wylogowanie">Wyloguj</a>
                  <router-link v-if="role === 'Kierownik'" to="/pracownicy" class="nav-item nav-link">Lista Pracowników</router-link>
                  <router-link to="/zlecenia" class="nav-item nav-link">Lista Zleceń</router-link>
                  <router-link to="/wykonane" class="nav-item nav-link">Lista Wykonanych Zleceń</router-link>
                </div>
                <div v-else class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">Program</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <router-view/>
    </div>
</template>
<script>
export default {
    data() {
        return {
        zalogowany:false,
        user: null,
        role: null,
        }
    },
    created(){
      if(window.laravel.zalogowany){
      this.zalogowany = window.laravel.zalogowany;
      this.user = window.laravel.user.imie;
      this.role = window.laravel.role.slug;
      console.log(window.laravel.zlecenia);
      }
    },
    methods:{
    wylogowanie(e){
    e.preventDefault()
    axios.get('/sanctum/csrf-cookie').then(response => {
    axios.post('api/wyloguj')
    .then(response=>{
      if(response.data.success){
        window.location.href="/"
      }else{
        console.log(response)
      }
    })
    .catch(function (error) {
        console.error(error);
    })
    })
    }
    }
}
</script>
