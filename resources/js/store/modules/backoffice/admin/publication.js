import jwtInterceptor  from '../../../../shared/jwtInterceptor';
const state = () => ({

    infosPublicationCreateBySlugTypeShowStatus:null,
    infosPublicationCreateBySlugTypeShowMessage:null,
    infosPublicationCreateBySlugTypeShowData:[],

    infosPublicationStoreInfoAlertAnnonceStatus:null,
    infosPublicationStoreInfoAlertAnnonceMessage:null,
    infosPublicationStoreInfoAlertAnnonceData:[],
    infosPublicationStoreInfoAlertAnnonceErrors:[],

    
    infosPublicationStoreArticleFirstStepStatus:null,
    infosPublicationStoreArticleFirstStepMessage:null,
    infosPublicationStoreArticleFirstStepData:[],
    infosPublicationStoreArticleFirstStepErrors:[],
       
});
const getters = {
 
    getInfosPublicationCreateBySlugTypeShowStatus(state){
        return state.infosPublicationCreateBySlugTypeShowStatus;
    },

    getInfosPublicationCreateBySlugTypeShowMessage(state){
        return state.infosPublicationCreateBySlugTypeShowMessage;
    },

    getInfosPublicationCreateBySlugTypeShowData(state){
        return state.infosPublicationCreateBySlugTypeShowData;
    },   

     getInfosPublicationStoreInfoAlertAnnonceStatus(state){
        return state.infosPublicationStoreInfoAlertAnnonceStatus;
    },

    getInfosPublicationStoreInfoAlertAnnonceMessage(state){
        return state.infosPublicationStoreInfoAlertAnnonceMessage;
    },

    getInfosPublicationStoreInfoAlertAnnonceData(state){
        return state.infosPublicationStoreInfoAlertAnnonceData;
    },  
    
    getInfosPublicationStoreInfoAlertAnnonceErrors(state){
        return state.infosPublicationStoreInfoAlertAnnonceErrors;
    },  

    getInfosPublicationStoreArticleFirstStepStatus(state){
        return state.infosPublicationStoreArticleFirstStepStatus;
    },

    getInfosPublicationStoreArticleFirstStepMessage(state){
        return state.infosPublicationStoreArticleFirstStepMessage;
    },

    getInfosPublicationStoreArticleFirstStepData(state){
        return state.infosPublicationStoreArticleFirstStepData;
    },  
    
    getInfosPublicationStoreArticleFirstStepErrors(state){
        return state.infosPublicationStoreArticleFirstStepErrors;
    },  
}

const actions = {
    
    async publicationCreateBySlugTypeShowDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get(`backoffice/admin/publications/create/${payload.slug}/type_publications`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosPublicationCreateBySlugTypeShowStatus", "success");
            commit("setInfosPublicationCreateBySlugTypeShowMessage", response.data.message);
            commit("setInfosPublicationCreateBySlugTypeShowData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosPublicationCreateBySlugTypeShowStatus", "empty");
            commit("setInfosPublicationCreateBySlugTypeShowData", response.data.data);
            commit("setInfosPublicationCreateBySlugTypeShowMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosPublicationCreateBySlugTypeShowStatus", "error");
            commit("setInfosPublicationCreateBySlugTypeShowMessage", response.data.message);
        }
    },

    async publicationStoreInfoAlertAnnonceDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.post(`backoffice/admin/publications/create/${payload.slug}/store_info_alert_annonce`, payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosPublicationStoreInfoAlertAnnonceStatus", "success");
            commit("setInfosPublicationStoreInfoAlertAnnonceMessage", response.data.message);
            commit("setInfosPublicationStoreInfoAlertAnnonceData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosPublicationStoreInfoAlertAnnonceStatus", "empty");
            commit("setInfosPublicationStoreInfoAlertAnnonceErrors", response.data.data.errors);
            commit("setInfosPublicationStoreInfoAlertAnnonceMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosPublicationStoreInfoAlertAnnonceStatus", "error");
            commit("setInfosPublicationStoreInfoAlertAnnonceMessage", response.data.message);
        }
    },

    async publicationStoreArticleFirstStepDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.post(`backoffice/admin/publications/create/${payload.slug}/store_article_first_step`, payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosPublicationStoreArticleFirstStepStatus", "success");
            commit("setInfosPublicationStoreArticleFirstStepMessage", response.data.message);
            commit("setInfosPublicationStoreArticleFirstStepData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosPublicationStoreArticleFirstStepStatus", "empty");
            commit("setInfosPublicationStoreArticleFirstStepErrors", response.data.data.errors);
            commit("setInfosPublicationStoreArticleFirstStepMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosPublicationStoreArticleFirstStepStatus", "error");
            commit("setInfosPublicationStoreArticleFirstStepMessage", response.data.message);
        }
    },
}

const mutations = {
     

    setInfosPublicationCreateBySlugTypeShowStatus(state, value){
        state.infosPublicationCreateBySlugTypeShowStatus = value;
    },

    setInfosPublicationCreateBySlugTypeShowMessage(state, value){
        state.infosPublicationCreateBySlugTypeShowMessage = value;
    },

    setInfosPublicationCreateBySlugTypeShowData(state, value){
        state.infosPublicationCreateBySlugTypeShowData = value;
    },

    setInfosPublicationStoreInfoAlertAnnonceStatus(state, value){
        state.infosPublicationStoreInfoAlertAnnonceStatus = value;
    },

    setInfosPublicationStoreInfoAlertAnnonceMessage(state, value){
        state.infosPublicationStoreInfoAlertAnnonceMessage = value;
    },

    setInfosPublicationStoreInfoAlertAnnonceData(state, value){
        state.infosPublicationStoreInfoAlertAnnonceData = value;
    },

    setInfosPublicationStoreInfoAlertAnnonceErrors(state, value){
        state.infosPublicationStoreInfoAlertAnnonceErrors = value;
    },

    setInfosPublicationStoreArticleFirstStepStatus(state, value){
        state.infosPublicationStoreArticleFirstStepStatus = value;
    },

    setInfosPublicationStoreArticleFirstStepMessage(state, value){
        state.infosPublicationStoreArticleFirstStepMessage = value;
    },

    setInfosPublicationStoreArticleFirstStepData(state, value){
        state.infosPublicationStoreArticleFirstStepData = value;
    },

    setInfosPublicationStoreArticleFirstStepErrors(state, value){
        state.infosPublicationStoreArticleFirstStepErrors = value;
    },
 
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
