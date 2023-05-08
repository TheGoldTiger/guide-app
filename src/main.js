import { createApp } from 'vue';
import App from "./App";
import router from "./router";
import {store} from "./store";
import './style/css/tailwind.css';
import './style/css/transitions.css';
const app = createApp(App);
app.config.globalProperties.$formatDate = (date) => {
    let year = date.slice(0,4);
    const months = ["ledna", "února", "března", "dubna", "května", "června", "července", "srpna", "září", "října", "listopadu", "prosince"];
    let month = months[parseInt(date.slice(5,7), 10)-1];
    let day = parseInt(date.slice(8,10), 10);
    return day+". "+month+ " "+year;
};
app.use(router);
app.use(store);
app.mount("#app");