/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import Axios from "axios";
import "bootstrap";

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
});

const alertWindow = document.getElementById("alert-window");
const blurredBackground = document.getElementById("background");
const deleteButton = document.getElementById("delete-button");
const confirmationForm = document.getElementById("confirmation-form");
const cancelButton = document.getElementById("cancel-button");
const deleteButtonList = document.querySelectorAll(".delete-button");

if (deleteButton) {
    deleteButton.addEventListener("click", switchAlert);
    cancelButton.addEventListener("click", switchAlert);
}

if (deleteButtonList) {
    deleteButtonList.forEach((button) =>
        button.addEventListener("click", switchAlertAndSetFormAction)
    );
}

function switchAlertAndSetFormAction() {
    switchAlert();
    confirmationForm.action =
        confirmationForm.dataset.base + "/" + this.dataset.id;
    cancelButton.addEventListener("click", switchAlert);
}

function switchAlert() {
    alertWindow.classList.toggle("d-none");
    blurredBackground.classList.toggle("d-none");
}

const sluggerBtn = document.getElementById("slugger-btn");
if (sluggerBtn) {
    sluggerBtn.addEventListener("click", function () {
        const slugInput = document.querySelector("#slug");
        const title = document.querySelector("#title").value;
        Axios.post('/admin/slugger', {
            originalStr: title,
        })
            .then(function (response) {
                slugInput.value = response.data.slug;
            });
    });
}