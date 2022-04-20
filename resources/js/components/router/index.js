import { createWebHistory, createRouter } from "vue-router";
import pracownicy from "../listapracownikow.vue";
import home from "../home.vue";
import zlecenia from "../zlecenia.vue";
import wykonane from "../wykonane-zlecenia.vue";
import login from "../login.vue";
import dodawanie from "../add_zlecenie.vue";
import edytujzlecenia from "../edytujz.vue";
import dashboard from "../Dashboard.vue";
import role from "../dodajrole.vue";
import pracownik from "../DashBoard/pracownik.vue";
const routes = [
  {
    path:"/",
    name:"home",
    component:home,
  },
  {
    path: "/pracownicy",
    name: "lista.pracownikow",
    component: pracownicy,
  },
  {
    path: "/zlecenia",
    name: "zlecenia",
    component: zlecenia,
  },
  {
    path: "/wykonane",
    name: "lista.wykonane",
    component: wykonane,
  },
  {
    path: "/login",
    name: "logowanie",
    component: login,
  },
  {
    path: "/dodawanie",
    name: "lista.dodawanie",
    component: dodawanie,
  },
  {
    path: "/edytowanie/:id",
    name: "edytuj.zlecenia",
    component:edytujzlecenia,
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component:dashboard,
  },
  {
    path: "/role",
    name: "pracownicy.role",
    component: role,
  },
  {
    path: "/dashboard/pracownik",
    name: "dashboard.pracownik",
    component: pracownik,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
