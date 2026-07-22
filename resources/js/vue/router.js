import { createRouter, createWebHashHistory } from "vue-router";

import List from "./components/ListComponent.vue";
import Save from "./components/SaveComponent.vue";

const routes = [
    {
        path: "/",
        name: "list",
        component: List,
    },
    {
        path: "/save/:slug?",
        name: "save",
        component: Save,
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes:routes,
});

export default router;