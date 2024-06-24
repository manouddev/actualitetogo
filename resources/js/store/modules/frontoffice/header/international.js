import axios from "axios";
const state = () => ({
    infosInternationalStatus:null,
    infosInternationalMessage:null,
    infosInternationalData:[],
});
const getters = {

    getInfosInternationalStatus(state){
        return state.infosInternationalStatus;
    },

    getInfosInternationalMessage(state){
        return state.infosInternationalMessage;
    },

    getInfosInternationalData(state){
        return state.infosInternationalData;
    },
   
}

const actions = {
    async internationalDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/header/international").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosInternationalStatus", "success");
            commit("setInfosInternationalMessage", response.data.message);
            commit("setInfosInternationalData", response.data.data.internationalData);
        }else if(response.data.data.status == 401) {
            commit("setInfosInternationalStatus", "empty");
            commit("setInfosInternationalMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosInternationalStatus", "error");
            commit("setInfosInternationalMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosInternationalStatus(state, value){
        state.infosInternationalStatus = value;
    },

    setInfosInternationalMessage(state, value){
        state.infosInternationalMessage = value;
    },

    setInfosInternationalData(state, value){
        state.infosInternationalData = value;
    },
   
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
