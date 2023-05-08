import { createRouter, createWebHashHistory } from "vue-router";
import Home from "./views/Home.vue";
import About from "./views/About.vue";
import Register from "./views/Register.vue";
import Vysledky from "./views/Vysledky.vue";
import Login from "./views/Login.vue";
import { store } from "./store";

const Story = () => import('./views/user/Story.vue');


const authMiddleware = (requireAuth = true) => ({
  beforeEnter: async (to, from, next) => {
    let signedIn = false;
    if (localStorage.getItem('token')) {
      var token = localStorage.getItem('token');
      await store.dispatch('getUserByToken', token).then((result)=>{
        if (!result) {
          localStorage.removeItem('token');
        } else {
          signedIn = true;
        }
      })
    }
    if (requireAuth=='vysledky') {
      next();
    } else if(!requireAuth){
      if(!signedIn){
        next();
      }else{
        next({ name: 'Story' })
      } 
    } else {
      if(signedIn){
        next();
      }else{
        next({ name: 'Home' })
      } 
    }
  }
})


const router = createRouter({
  history: createWebHashHistory(),
  routes: [
    {
      path: "/home",
      name: "Home",
      component: Home,
      ...authMiddleware(false),
    },
    {
      path: "/about",
      name: "About",
      component: About,
      ...authMiddleware(false),
    },
    {
      path: "/register",
      name: "Register",
      component: Register,
      ...authMiddleware(false),
    },
    {
      path: "/login",
      name: "Login",
      component: Login,
      ...authMiddleware(false),
    },
    {
      path: "/story",
      name: "Story",
      component: Story,
      ...authMiddleware(true),
    },
    {
      path: "/vysledky",
      name: "Vysledky",
      component: Vysledky,
      ...authMiddleware("vysledky"),
    },
    {
      path: "/",
      redirect: "Home",
    },
  ],
});

export default router;
