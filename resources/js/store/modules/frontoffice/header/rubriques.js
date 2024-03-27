import axios from "axios";
const state = () => ({
    infosRubriquesStatus:null,
    infosRubriquesMessage:null,
    infosRubriquesData:[],
});
const getters = {

    getInfosRubriquesStatus(state){
        return state.infosRubriquesStatus;
    },

    getInfosRubriquesMessage(state){
        return state.infosRubriquesMessage;
    },

    getInfosRubriquesData(state){
        return state.infosRubriquesData;
    },
   
}

const actions = {
    async rubriquesDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/header/rubriques").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosRubriquesStatus", "success");
            commit("setInfosRubriquesMessage", response.data.message);
            commit("setInfosRubriquesData", response.data.data.rubriquesData);
        }else if(response.data.data.status == 401) {
            commit("setInfosRubriquesStatus", "empty");
            commit("setInfosRubriquesMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosRubriquesStatus", "error");
            commit("setInfosRubriquesMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosRubriquesStatus(state, value){
        state.infosRubriquesStatus = value;
    },

    setInfosRubriquesMessage(state, value){
        state.infosRubriquesMessage = value;
    },

    setInfosRubriquesData(state, value){
        state.infosRubriquesData = value;
    },
   
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
