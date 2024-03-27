import axios from "axios";
const state = () => ({
    infosDiasporaStatus:null,
    infosDiasporaMessage:null,
    infosDiasporaData:[],
});
const getters = {

    getInfosDiasporaStatus(state){
        return state.infosDiasporaStatus;
    },

    getInfosDiasporaMessage(state){
        return state.infosDiasporaMessage;
    },

    getInfosDiasporaData(state){
        return state.infosDiasporaData;
    },
   
}

const actions = {
    async diasporaDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/header/diaspora").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosDiasporaStatus", "success");
            commit("setInfosDiasporaMessage", response.data.message);
            commit("setInfosDiasporaData", response.data.data.diasporaData);
        }else if(response.data.data.status == 401) {
            commit("setInfosDiasporaStatus", "empty");
            commit("setInfosDiasporaMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosDiasporaStatus", "error");
            commit("setInfosDiasporaMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosDiasporaStatus(state, value){
        state.infosDiasporaStatus = value;
    },

    setInfosDiasporaMessage(state, value){
        state.infosDiasporaMessage = value;
    },

    setInfosDiasporaData(state, value){
        state.infosDiasporaData = value;
    },
   
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
