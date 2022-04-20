<template>
<h1>{{role}} {{imie}}</h1>
</template>
<script>
export default {
    data() {
        return {
            imie: null,
            role: null,
        }
    },
    created(){
    if(window.laravel.user){
      this.imie = window.laravel.user.imie;
      this.role = window.laravel.role.slug;
      console.log(window.laravel);
      }
    }
  }
</script>
