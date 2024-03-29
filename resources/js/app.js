/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

const stud = createApp({});

import App from './components/Student/App_student.vue';
stud.component('App_student', App);

const teach = createApp({});

import App_T from './components/Teacher/App_teacher.vue';
teach.component('App_teacher', App_T);

const paren = createApp({});

import App_P from './components/Parent/App_parent.vue';
paren.component('App_parent', App_P);

const master = createApp({});

import App_H from './components/Headmaster/App_Headmaster.vue';
master.component('App_headmaster', App_H)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
stud.mount('#student_app');
teach.mount('#teacher_app');
paren.mount('#parent_app');
master.mount('#headmaster_app');
