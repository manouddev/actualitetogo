<template>
    <span v-if="dataReady === 0"></span>
    <span v-else-if="dataReady == 1">
        <span v-if="meProfileRoleName === 'Administrateur'">
            <a class="nav-link" href="/admin/dashboard">Tableau de bord</a>
        </span>
        <span v-else-if="meProfileRoleName === 'Publicateur d\' articles'">
            <a class="nav-link" href="/pub/dashboard">Tableau de bord</a>
        </span>
        <span v-else-if="meProfileRoleName === 'Visiteur'">
            <a class="nav-link" href="/profile">Voir mon profil</a>
        </span>
    </span>
    <span v-else-if="dataReady == 2">
        <span class="nav-link" v-if="!loadingConnect"  @click="loginClick" style="cursor: pointer">Se connecter</span>
        <span class="nav-link" v-else-if="loadingConnect" style="cursor: pointer">Connexion en cours ...</span>
    </span>

    <span v-else-if="dataReady == 3 ">
        <span class="nav-link" v-if="!loadingConnect"  @click="loginClick" style="cursor: pointer">Se connecter</span>
        <span class="nav-link" v-else-if="loadingConnect" style="cursor: pointer">Connexion en cours ...</span>
    </span>

   
</template>
<script>
import { mapGetters, mapActions} from "vuex";
import store from '../../../store/index'
export default {
    // inside your script 
    data () {
        return {
            dataReady: 0,
            meProfileUserName: null,
            meProfileRoleName: null,
            loadingConnect: false
        }
    },
    computed: {
        ...mapGetters("meProfile",{
            gettersMeProfileUserName:"getMeProfileUserName",
            gettersMeProfileRoleName:"getMeProfileRoleName",
            gettersMeProfileStatus:'getMeProfileStatus',
        }),

        ...mapGetters('login',{
            getterLoginStatus:'getLoginStatus',
            getterLoginMessage:'getLoginMessage',
            getterLoginErrors:'getLoginErrors',
        }),
        
    },
    methods:{
      ...mapActions("meProfile",{
          actionsGetMeProfile:'getMeProfile'
      }),

      ...mapActions('login',{
            actionLogin:'login'
        }),
      
      async show(){

        if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

            await this.actionsGetMeProfile();

            if(this.gettersMeProfileStatus === 'success'){

                this.meProfileRoleName = this.gettersMeProfileRoleName

                this.meProfileUserName = this.gettersMeProfileUserName

                this.dataReady = 1;

            

            }else if(this.gettersMeProfileStatus === 'failed'){

                this.dataReady = 3;

            }

        }else{

            this.dataReady = 2;

        

        }
           
        
      },

      async loginClick(){

        if(localStorage.getItem('remember_me') == "true" && localStorage.getItem('username') && localStorage.getItem('password')){

            this.loadingConnect = true

            this.remember_me = localStorage.getItem('remember_me')

            await this.actionLogin({username: localStorage.getItem('username'), password: localStorage.getItem('password'), remember_me: localStorage.getItem('remember_me')});

                   
            if(this.getterLoginStatus === 'success admin'){

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
                    title: this.getterLoginMessage
                })

               

                window.location = '/admin/dashboard'
                

                

            }else if(this.getterLoginStatus === 'success pub'){

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
                    title: this.getterLoginMessage
                })

             

                    window.location = '/pub/dashboard'



                

            }else if(this.getterLoginStatus === 'success visitor'){

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
                    title: this.getterLoginMessage
                })

              

                    window.location = '/'
        
                

            }else if(this.getterLoginStatus === 'failed'){
                
                window.location = '/auth/login'

            }else if(this.getterLoginStatus === 'error'){
                
                window.location = '/auth/login'
            }

        }else{

            window.location = '/auth/login'

        }
        
      },

    },
    mounted() {
     this.show();
    },
};
</script>