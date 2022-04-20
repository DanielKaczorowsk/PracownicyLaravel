<template>
<ul class="nav justify-content-center p-4">
  <li class="nav-item p-4">
  <button @click="form=false" class="btn btn-dark">Logowanie</button>
  </li>
  <li class="nav-item p-4">
  <button @click="form=true" class="btn btn-dark">Rejestracja</button>
  </li>
  </ul>
  <div class="row justify-content-center">
  <form v-if="form===false">
  <div class="text-center">
    <h2 class="p-4">Zaloguj się</h2>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">E-mail</label>
    <input type="email" class="form-control" id="exampleInputEmail1" v-model="email" placeholder="E-mail">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Hasło</label>
    <input type="password" class="form-control" id="exampleInputPassword1" v-model="password" aria-describedby="haslohelper" placeholder="Hasło">
    <small id="haslohelper" class="form-text text-muted">Nie udostępniaj nikomu hasła.</small>
  </div>
  <button type="submit" class="btn btn-dark" @click="logowanie">Zaloguj</button>
</form>
  <form v-else>
  <div class="text-center">
  <h2 class="p-4">Zarejestruj się</h2>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">E-mail</label>
    <input type="email" class="form-control" id="exampleInputEmail1" v-model="email" placeholder="E-mail">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Imię</label>
    <input type="text" class="form-control" id="exampleInputEmail1" v-model="imie" placeholder="Imię">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nazwisko</label>
    <input type="text" class="form-control" id="exampleInputEmail1" v-model="nazwisko" placeholder="Nazwisko">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Hasło</label>
    <input type="password" class="form-control" id="exampleInputPassword1" v-model="password" aria-describedby="haslohelper" placeholder="Hasło">
    <small id="haslohelper" class="form-text text-muted">Nie udostępniaj nikomu hasła.</small>
  </div>
  <button type="submit" class="btn btn-dark" @click="rejestracja">Zarejestruj</button>
</form>
</div>
</template>
<script>
export default {
    data() {
        return {
        form: false,
        email:'',
        password:'',
        role: null
        }
    },
    created(){
    if(window.laravel.zalogowany){
    this.role = window.laravel.role.slug;
    if(window.laravel.role.slug){
    switch(this.role){
      case 'Kierownik':
      window.location.href="/dashboard/kierownik";
      break;
      case 'Pracownik':
      window.location.href="/dashboard/pracownik";
      break;
      default:
      window.location.href="/zlecenia";
    }
    }else{
    window.location.href="/dashboard";
    }
    }
    },
    methods:{
    logowanie(e){
    e.preventDefault()
    axios.get('/sanctum/csrf-cookie').then(response => {
    axios.post('api/logowanie',{email:this.email,password:this.password})
    .then(response=>{
    if(response.data.success){
    if(window.laravel.user){
      window.location.href="/dashboard/pracownik";
    }
    }else{
    console.log(response.data.message)
    }
    })
    .catch(function (error){
      console.error(error);
    });
    })
    },
    rejestracja(e){
    e.preventDefault()
    axios.get('/sanctum/csrf-cookie').then(response => {
    axios.post('api/rejestracja',{
    email:this.email,
    imie:this.imie,
    nazwisko:this.nazwisko,
    password:this.password
    })
    .then(response=>{
      if(response.data.success){
      this.$router.go({name:'zlecenia'})
    }else{
      console.log(response.data.message)
    }
    })
    .catch(function (error){
      console.error(error);
    });
    })
    },
  }
  }
</script>
