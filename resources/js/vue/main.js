import { createApp } from "vue";

import Oruga from "@oruga-ui/oruga-next";
import { useNotificationProgrammatic } from "@oruga-ui/oruga-next";

import App from "./App.vue";
import axios from "axios";
import router from "./router.js";

// import Oruga from "@oruga-ui/oruga-next";
import {    OInput, OButton, OField, OTable, OTableColumn, OUpload, OIcon,
            OPagination, OSelect, OModal, ONotification } from "@oruga-ui/oruga-next";

import '/node_modules/@oruga-ui/theme-oruga/dist/theme.css';
import '@mdi/font/css/materialdesignicons.min.css'

import '../../../node_modules/@oruga-ui/theme-oruga/dist/theme.css';


const app = createApp(App)

app.use(Oruga);
app.use(router);

app.config.globalProperties.$notification = useNotificationProgrammatic();

app.component("o-button", OButton);
app.component("o-field", OField);
app.component("o-input", OInput);
app.component("o-table", OTable);
app.component("o-table-column", OTableColumn);
app.component("o-pagination", OPagination);
app.component("o-select", OSelect);
app.component("o-modal", OModal);
app.component("o-notification", ONotification );
app.component("o-upload", OUpload );
app.component("o-icon", OIcon );


app.config.globalProperties.$axios = axios
window.axios = axios

app.mount("#app")