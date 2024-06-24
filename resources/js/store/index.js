import { createStore } from "vuex";

//Importation des modules gérant les données contenu dans l'entête de page

import togoactualiteModule from './modules/frontoffice/header/togoactualite'

import rubriquesModule from './modules/frontoffice/header/rubriques'

import economieModule from './modules/frontoffice/header/economie'

import diasporaModule from './modules/frontoffice/header/diaspora'

import internationalModule from './modules/frontoffice/header/international'

import sportsModule from './modules/frontoffice/header/sports'

//Importation des modules gérant les données contenu dans le pied de page

import newsletterModule from './modules/frontoffice/footer/newsletter'

import articlesPopularsModule from './modules/frontoffice/footer/articlesPopulars'

import categoryPopularsModule from './modules/frontoffice/footer/categoryPopulars'

import tagsPopularsModule from './modules/frontoffice/footer/tagsPopulars'
  
//Le fonctionnalités pour l'authentification

import loginModule from './modules/auth/login';

import meProfileModule from './modules/auth/meProfile';

import logoutModule from './modules/auth/logout';

import registerModule from './modules/auth/register';

import forgot_passwordModule from './modules/auth/forgot_password';

//Sécurité pour les pages d'administration

import roleModule from './modules/backoffice/role'
  
const store = createStore({
    modules:{

        //Déclaration des modules gérant les données contenu dans l'entête de page

        togoactualite: togoactualiteModule,
        rubriques: rubriquesModule,
        economie: economieModule,
        diaspora: diasporaModule,
        international: internationalModule,
        sports: sportsModule,

        //Déclaration des modules gérant les données contenu dans le pied de page

        newsletter: newsletterModule,
        articlesPopulars: articlesPopularsModule,
        categoryPopulars: categoryPopularsModule,
        tagsPopulars: tagsPopularsModule,
  
        //Déclaration des modules gérant les données du système d'authenitification

        login: loginModule,
        logout:logoutModule,
        meProfile: meProfileModule,
        forgot_password: forgot_passwordModule,
        register: registerModule,

        //Déclaration des modules gérant les données du système de la securité su site

        roleSecurity: roleModule, 
    }
  });

  export default store;
