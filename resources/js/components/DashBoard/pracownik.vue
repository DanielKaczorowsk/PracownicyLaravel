<template>
<h1>{{role}} {{imie}}</h1>
<div class='text-center'>
    <h4>Zlecenia do wykonania</h4><br/>
    <table class="table table-bordered">
      <thead>
        <tr>
            <th>Dane Klienta</th>
            <th>Urządzenie</th>
            <th>Usterka</th>
            <th>Uwaga</th>
            <th>Limit Kosztów</th>
        </tr>
      </thead>
      <tbody>
          <tr v-for="(zlecenie,index) in zlecenia" :key="index">
              <td>Edward tel:664038952</td>
              <td>{{zlecenie.urzadzenie}}</td>
              <td>{{zlecenie.usterka}}</td>
              <td>{{zlecenie.uwaga}}</td>
              <td>{{zlecenie.limitkosztow}} zł</td>
              </tr>
          </tbody>
    </table>
</div>
</template>
<script>
export default {
    data() {
        return {
            imie: null,
            role: null,
            zlecenia: []
        }
    },
    created(){
    if(window.laravel.user){
      this.imie = window.laravel.user.imie;
      this.role = window.laravel.role.slug;
      this.zlecenia = window.laravel.zlecenia;
      }
    }
  }
</script>
