import './bootstrap';

//Importation des librairies js

import { createApp } from 'vue'

import VueSweetalert2 from 'vue-sweetalert2';

import 'sweetalert2/dist/sweetalert2.min.css';

import store from './store/index';

//Importation, déclaration et chargement des composants inclus dans le header

import togoactualiteHeader from './components/frontoffice/header/togoactualite.vue'

const togoactualite = createApp(togoactualiteHeader)

togoactualite.use(store)

togoactualite.mount('#togoactualite')

import rubriquesHeader from './components/frontoffice/header/rubriques.vue'

const rubriques = createApp(rubriquesHeader)

rubriques.use(store)

rubriques.mount('#rubriques')

import economieHeader from './components/frontoffice/header/economie.vue'

const economie = createApp(economieHeader)

economie.use(store)

economie.mount('#economie')

import diasporaHeader from './components/frontoffice/header/diaspora.vue'

const diaspora = createApp(diasporaHeader)

diaspora.use(store)

diaspora.mount('#diaspora')

import internationalHeader from './components/frontoffice/header/international.vue'

const international = createApp(internationalHeader)

international.use(store)

international.mount('#international')

import sportsHeader from './components/frontoffice/header/sports.vue'

const sports = createApp(sportsHeader)

sports.use(store)

sports.mount('#sports')

//Importation, déclaration et chargement des composants inclus dans le footer

import newsletterFooter from './components/frontoffice/footer/newsletter.vue'

const newsletter = createApp(newsletterFooter)

newsletter.use(VueSweetalert2)

newsletter.use(store)

newsletter.mount('#newsletter')

import articlesPopularsFooter from './components/frontoffice/footer/articlesPopulars.vue'

const articlesPopulars = createApp(articlesPopularsFooter)

articlesPopulars.use(store)

articlesPopulars.mount('#articlesPopulars')

import categoryPopularsFooter from './components/frontoffice/footer/categoryPopulars.vue'

const categoryPopulars = createApp(categoryPopularsFooter)

categoryPopulars.use(store)

categoryPopulars.mount('#categoryPopulars')

import tagsPopularsFooter from './components/frontoffice/footer/tagsPopulars.vue'

const tagsPopulars = createApp(tagsPopularsFooter)

tagsPopulars.use(store)

tagsPopulars.mount('#tagsPopulars')
 