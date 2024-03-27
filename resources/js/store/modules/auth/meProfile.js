import jwtInterceptor  from '../../../shared/jwtInterceptor';
 
const state = () => ({
  meProfileUserName : "",
  meProfileName : "",
  meProfileEmail : "",
  meProfileRoleName: "",
  profileStatus:"",
});
 
const getters = {
  getMeProfileUserName(state){
   return  state.meProfileUserName;
  },
  getMeProfileRoleName(state){
    return state.meProfileRoleName;
   },
  getProfileStatus(state){
    return state.profileStatus;
  },
  getProfileEmail(state){
    return state.profileEmail;
  },
  getProfileName(state){
    return state.profileName;
  },
};
 
const actions = {
    async getMeProfile({commit}){
        var response = await jwtInterceptor.post('me').catch((err) =>{
          if(err.response.status == 401){
            commit("setProfileStatus", "expired");
          }
        });
        if(response && response.data.status == 200){
            commit("setProfileStatus", "success");
            commit('setMeProfileUserName', response.data.user.username);
            commit('setProfileEmail', response.data.user.email);
            commit('setProfileName', response.data.user.prenoms);
            commit('setMeProfileRoleName', response.data.user.role_name);
        }else{
          commit("setProfileStatus", "failed");
        }
    }
};
 
const mutations = {
  setMeProfileUserName(state, value){
   state.meProfileUserName = value;
  },

  setMeProfileRoleName(state, value){
    state.meProfileRoleName = value;
   },

  setProfileStatus(state, value){
    state.profileStatus = value;
  },

  setProfileName(state, value){
    state.profileName= value;
  },

  setProfileEmail(state, value){
    state.profileEmail = value;
  },
};
 
export default{
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}