<template>
    <div v-if="dataReady === 0"></div>
    <div v-else-if="dataReady === 2"></div>
    <!-- Profile dropdown START -->
    <div class="nav-item ms-2 ms-md-3 dropdown" v-else-if="dataReady === 1">
        <!-- Avatar -->
        <a class="avatar avatar-xs"  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
            <div class="avatar-img rounded-circle bg-primary">
                <span v-if="meProfileRoleName === 'Administrateur'" class="text-light position-absolute top-50 start-50 translate-middle fw-bold small">{{ meProfileUserName[0].toUpperCase()  }}</span>
                <span v-else-if="meProfileRoleName === 'Publicateur d\' articles'" class="text-light position-absolute top-50 start-50 translate-middle fw-bold small">{{ meProfileUserName[0].toUpperCase()  }}</span>
                <span v-else-if="meProfileRoleName === 'Visiteur'" class="text-light position-absolute top-50 start-50 translate-middle fw-bold small">{{ meProfileUserName[0].toUpperCase()  }}</span>
            </div>
        </a>

        <!-- Profile dropdown START -->
        <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
            <!-- Profile info -->
            <li class="px-3">
                <div class="d-flex align-items-center">
                    <!-- Avatar -->
                    <div class="avatar avatar-xs">
                        <div class="avatar-img rounded-circle bg-primary">
                            <span v-if="meProfileRoleName === 'Administrateur'" class="text-light position-absolute top-50 start-50 translate-middle fw-bold small">{{ meProfileUserName[0].toUpperCase()  }}</span>
                            <span v-else-if="meProfileRoleName === 'Publicateur d\' articles'" class="text-light position-absolute top-50 start-50 translate-middle fw-bold small">{{ meProfileUserName[0].toUpperCase()  }}</span>
                            <span v-else-if="meProfileRoleName === 'Visiteur'" class="text-light position-absolute top-50 start-50 translate-middle fw-bold small">{{ meProfileUserName[0].toUpperCase()  }}</span>
                        </div>
                    </div>
                    &nbsp; &nbsp; &nbsp;
                    <div v-if="meProfileRoleName === 'Administrateur' ">
                        <a class="h6 mt-2 mt-sm-0" href="#">{{meProfileUserName}}</a>
                        <p class="small m-0">{{meProfileRoleName}}</p>
                    </div>
                    <div v-else-if="meProfileRoleName === 'Publicateur d\' articles' ">
                        <a class="h6 mt-2 mt-sm-0" href="#">{{meProfileUserName}}</a>
                        <p class="small m-0">{{meProfileRoleName}}</p>
                    </div>
                    <div v-else-if="meProfileRoleName === 'Visiteur' ">
                        <a class="h6 mt-2 mt-sm-0" href="#">{{meProfileUserName}}</a>
                        <p class="small m-0">{{meProfileEmail}}</p>
                    </div>
                </div>
                <hr>
            </li>
            <!-- Links -->
            <li><a class="dropdown-item" href="#"><i class="bi bi-person fa-fw me-2"></i>Editer mon profil</a></li>
            <li  v-if="meProfileRoleName === 'Administrateur' "><a class="dropdown-item" href="/admin/dashboard"><i class="bi bi-house-door fa-fw me-2"></i>Tableau de bord</a></li>
            <li v-else-if="meProfileRoleName === 'Publicateur d\' articles' "><a class="dropdown-item" href="/pub/dashboard"><i class="bi bi-house-door fa-fw me-2"></i>Tableau de bord</a></li>
            <li>
                <span class="dropdown-item" v-if="!logoutCheck" style="cursor: pointer" @click="logout"><i class="bi bi-power fa-fw me-2"></i>Se deconnecter</span>
                <span class="dropdown-item" v-else ><i class="bi bi-power fa-fw me-2"></i>Déconnexion en cours ...</span>
            </li>
            
        </ul>
        <!-- Profile dropdown END -->
    </div>
    <!-- Profile dropdown END -->
</template>
<script>
import { mapGetters, mapActions, mapMutations } from "vuex";
import store from '../../../store/index'
export default {
    // inside your script 
    data () {
        return {
            dataReady: 0,
            meProfileUserName: null,
            meProfileRoleName: null,
            meProfileEmail: null,
            meProfileName: null,
            logoutCheck:false
            // other data
        }
    },
    computed: {
        ...mapGetters("meProfile",{
            gettersMeProfileUserName:"getMeProfileUserName",
            gettersMeProfileRoleName:"getMeProfileRoleName",
            gettersMeProfileStatus:'getMeProfileStatus',
            gettersMeProfileName:'getMeProfileName',
            gettersMeProfileEmail:'getMeProfileEmail',
        }),
        ...mapGetters("auth", {
            gettersAuthData: "getAuthData",
        }),

        ...mapGetters('logout',{
            getterLogoutStatus:'getLogoutStatus',
            getterLogoutMessage:'getLogoutMessage',
            
        })
    },
    methods:{
      ...mapActions("meProfile",{
          actionsGetMeProfile:'getMeProfile'
      }),
      ...mapActions("logout",{
          actionsGetLogout:'getLogoutApi'
      }),

      ...mapMutations('auth',{
            saveTokenData: 'saveTokenData'
      }),

      ...mapMutations('logout',{
            setlogout: 'setLogout'
      }),

      async show(){

        if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){
           
            await this.actionsGetMeProfile();

            if(this.gettersMeProfileStatus === 'success'){

                this.meProfileRoleName = this.gettersMeProfileRoleName

                this.meProfileUserName = this.gettersMeProfileUserName

                this.meProfileEmail = this.gettersMeProfileEmail

                this.meProfileName = this.gettersMeProfileName

                this.dataReady = 1;

            

            }else if(this.gettersMeProfileStatus === 'failed'){

                this.dataReady = 2;

            }

        }else{

            this.dataReady = 2;

        }
      },

      async logout(){

        this.logoutCheck = true

        await this.actionsGetLogout();

        if(this.getterLogoutStatus === 'success'){

            const Toast = this.$swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', this.$swal.stopTimer)
                    toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: this.getterLogoutMessage
            })

            const  clearToken = {
                access_token: null,
                expires_in: null
            }

            store.getters["login/getAuthData"].access_token = clearToken.access_token
            store.getters["login/getAuthData"].expires_in = clearToken.expires_in

            window.location = '/auth/login'

            this.logoutCheck = false

        }

      },
    },
    mounted() {
     this.show();
    },
};
</script>