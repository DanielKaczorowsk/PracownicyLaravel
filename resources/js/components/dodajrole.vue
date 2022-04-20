<template>
<div>
        <h4 class="text-center">Dodaj Zlecenie</h4>
        <div class="row justify-content-center">
            <div class="col-md-6">
            <form>
                <div class="form-group p-1">
                    <label for="exampleFormControlSelect1">Wybierz Pracownika</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                      <option v-for="dane in gdane" :key="dane.id" :value="dane.id">
                      <a v-for="user in dane" :key="user.id">{{user.imie}}</a></option>
                    </select>
               </div>
                <div class="form-group p-1">
                    <label for="exampleFormControlSelect1">Wybierz Role</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                      <option v-for="rola in gdane" :key="rola.id" :value="rola.id">{{rola.slug}}</option>
                    </select>
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
            gdane: [],
            pdane: {}
        }
    },
    created() {
    axios.get('/sanctum/csrf-cookie').then(response => {
      axios.get('api/getrole')
        .then(response => {
            this.gdane=response.data;
        })
        .catch(function (error) {
            console.error(error);
        });
        })
    },
}
</script>
