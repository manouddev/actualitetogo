import jwtInterceptor  from '../../../shared/jwtInterceptor';

const state = () => ({
  meProfileUserName :  null,
  meProfileName :  null,
  meProfileEmail :  null,
  meProfileRoleName:  null,
  meProfileStatus: null,

});

const getters = {
    getMeProfileUserName(state){
    return  state.meProfileUserName;
    },
    getMeProfileRoleName(state){
        return state.meProfileRoleName;
    },
    getMeProfileStatus(state){
        return state.meProfileStatus;
    },
    getMeProfileEmail(state){
        return state.meProfileEmail;
    },
    getMeProfileName(state){
        return state.meProfileName;
    },


};

const actions = {
    async getMeProfile({commit}){
        var response = await jwtInterceptor.post('me').catch((err) =>{
          if(err.response.status == 401){
            commit("setMeProfileStatus", "expired");
          }
        });
        if(response && response.data.status == 200){
            commit("setMeProfileStatus", "success");
            commit('setMeProfileUserName', response.data.user.username);
            commit('setMeProfileEmail', response.data.user.email);
            commit('setMeProfileName', response.data.user.prenoms);
            commit('setMeProfileRoleName', response.data.user.role_name);
        }else{
          commit("setMeProfileStatus", "failed");
        }
    },

};

const mutations = {
  setMeProfileUserName(state, value){
   state.meProfileUserName = value;
  },

  setMeProfileRoleName(state, value){
    state.meProfileRoleName = value;
   },

  setMeProfileStatus(state, value){
    state.meProfileStatus = value;
  },

  setMeProfileName(state, value){
    state.meProfileName= value;
  },

  setMeProfileEmail(state, value){
    state.meProfileEmail = value;
  },
};

export default{
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
