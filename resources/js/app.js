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

//Importation du Composant de contact à afficher sur la page d'accueil

import ContactF from './components/frontoffice/home_page/contact.vue'

const contact = createApp(ContactF)

contact.use(VueSweetalert2);

contact.use(store);

contact.mount('#contact')
 
//Gestion de tous les composants administrateurs

import * as adminRouter from './router/adminRouter';

import administrateurA from './components/backoffice/administrateur/administrateur.vue'

import HeaderAdminComponent from './components/backoffice/administrateur/includes/HeaderAdminComponent.vue'

import FooterAdminComponent from './components/backoffice/administrateur/includes/FooterComponent.vue'

import authRequiredMessageAdminComponent from './components/backoffice/administrateur/errorMessage/sections/authRequiredMessage.vue'

import sessionExpiredMessageAdminComponent from './components/backoffice/administrateur/errorMessage/sections/sessionExpiredMessage.vue'

import accessUnAuthorizedAdminComponent from './components/backoffice/administrateur/errorMessage/sections/accessUnAuthorized.vue'

const administrateur = createApp(administrateurA)

administrateur.use(adminRouter.routeConfig);

administrateur.component('HeaderAdmin', HeaderAdminComponent)

administrateur.component('FooterAdmin',  FooterAdminComponent)

administrateur.component('authRequiredMessageAdmin', authRequiredMessageAdminComponent)

administrateur.component('accessUnAuthorizedAdmin', accessUnAuthorizedAdminComponent)

administrateur.component('sessionExpiredMessageAdmin', sessionExpiredMessageAdminComponent)

administrateur.use(VueSweetalert2)

administrateur.use(store)

administrateur.mount('#administrateur')

//Gestion de tous les composants publicateurs d'articles

import * as pubRouter from './router/pubRouter';

import publicateurA from './components/backoffice/publicateur/publicateur.vue'

import HeaderPubComponent from './components/backoffice/publicateur/includes/HeaderPubComponent.vue'

import FooterPubComponent from './components/backoffice/publicateur/includes/FooterComponent.vue'

import authRequiredMessagePubComponent from './components/backoffice/publicateur/errorMessage/sections/authRequiredMessage.vue'

import sessionExpiredMessagePubComponent from './components/backoffice/publicateur/errorMessage/sections/sessionExpiredMessage.vue'

import accessUnAuthorizedPubComponent from './components/backoffice/publicateur/errorMessage/sections/accessUnAuthorized.vue'

const publicateur = createApp(publicateurA)

publicateur.use(pubRouter.routeConfig);

publicateur.component('HeaderPub', HeaderPubComponent)

publicateur.component('FooterPub',  FooterPubComponent)

publicateur.component('authRequiredMessagePub', authRequiredMessagePubComponent)

publicateur.component('accessUnAuthorizedPub', accessUnAuthorizedPubComponent)

publicateur.component('sessionExpiredMessagePub', sessionExpiredMessagePubComponent)

publicateur.use(VueSweetalert2)

publicateur.use(store)

publicateur.mount('#publicateur')

//Verifier les connexions pour configurer les menus

import in_second_menuF from './components/frontoffice/verify_auth/in_second_menu.vue'

const in_second_menu = createApp(in_second_menuF)

in_second_menu.use(store)

in_second_menu.use(VueSweetalert2)

in_second_menu.mount('#in_second_menu')

import off_canvasF from './components/frontoffice/verify_auth/off_canvas.vue'

const off_canvas = createApp(off_canvasF)

off_canvas.use(store)

off_canvas.use(VueSweetalert2)

off_canvas.mount('#off_canvas')

import in_first_menuF from './components/frontoffice/verify_auth/in_first_menu.vue'

const in_first_menu = createApp(in_first_menuF)

in_first_menu.use(store)

in_first_menu.use(VueSweetalert2)

in_first_menu.mount('#in_first_menu')

//Importation des composants pour l'authentification

import loginH from './components/authentication/login.vue'

const login = createApp(loginH)

login.use(VueSweetalert2)

login.use(store)

login.mount('#login')

import forgot_passwordH from './components/authentication/forgot_password.vue'

const forgot_password = createApp(forgot_passwordH)

forgot_password.use(VueSweetalert2)

forgot_password.use(store)

forgot_password.mount('#forgot_password')

import registerH from './components/authentication/register.vue'

const register = createApp(registerH)

register.use(VueSweetalert2)

register.use(store)

register.mount('#register')
