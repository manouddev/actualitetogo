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
 
//Importation du module gérant les données d'envoi de messages

import contactModule from "./modules/frontoffice/home_page/contact"
 
//Importation du module gérant le changement des status des publications

import changeProgramModule from "./modules/frontoffice/home_page/changeProgram"

//Importation du module gérant les données des publications sur la page d'accueil

import homePageModule from './modules/frontoffice/home_page/home_page'
  
 
//Le fonctionnalités pour l'authentification

import loginModule from './modules/auth/login';

import meProfileModule from './modules/auth/meProfile';

import logoutModule from './modules/auth/logout';

import registerModule from './modules/auth/register';

import forgot_passwordModule from './modules/auth/forgot_password';

//Sécurité pour les pages d'administration

import roleModule from './modules/backoffice/role'
 
//Importation des modules gérant les données de la partie administrative 

import categoryAdminModule from './modules/backoffice/admin/category'
 
import authorsAdminModule from './modules/backoffice/admin/authors'

import typePublicationAdminModule from './modules/backoffice/admin/typePublication'
 
import tagsAdminModule from './modules/backoffice/admin/tags'

import newsLetterAdminModule from './modules/backoffice/admin/newsLetter'

import  publicationAdminModule from './modules/backoffice/admin/publication'


//Importation des modules gérant les données de la partie des publicateurs

import tagsPubModule from './modules/backoffice/publicator/tags'

import authorsPubModule from './modules/backoffice/publicator/authors'


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
 
        //Déclaration du module gérant les données d'envoi des messages

        contact: contactModule,

        //Déclaration du module gérant les données des publications sur la page d'accueil

        homePage: homePageModule,
        
        //Déclaration du module gérant le statut des publication

        changeProgram: changeProgramModule,
        
        //Déclaration des modules gérant les données du système d'authenitification

        login: loginModule,
        logout:logoutModule,
        meProfile: meProfileModule,
        forgot_password: forgot_passwordModule,
        register: registerModule,

        //Déclaration des modules gérant les données du système de la securité su site

        roleSecurity: roleModule,

        //Déclaration des modules gérant les données de la partie administrative

        typePublicationAdmin: typePublicationAdminModule,
        categoryAdmin: categoryAdminModule,  
        authorsAdmin: authorsAdminModule,  
        publicationAdmin: publicationAdminModule,
        tagsAdmin: tagsAdminModule,           
        newsLetterAdmin: newsLetterAdminModule,

        //Déclaration des modules gérant les données de la partie des publicateurs
        authorsPub: authorsPubModule,  
        tagsPub: tagsPubModule,   
    }
  });

  export default store;
