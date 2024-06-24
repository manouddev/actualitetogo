<template>
    <div class="container">

        <div v-if="loading">
            <br><br><br>
            <div class="d-flex justify-content-center mt-3">
                <div class="spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <br><br><br>
        </div>
        <div v-else class="row g-4 p-3 flex-fill">

            <div  v-if="empty === 1">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div style="position: relative; height: 250px;">
                          <img src="https://actualitetogo.com/assets/images/empty.png" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                      </div>
                      <h5 style="text-align: center; margin-top: -50px"> {{ diasporaMessage  }} </h5>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

            <div  v-if="empty === 3">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div style="position: relative; height: 250px;">
                          <img src="https://actualitetogo.com/assets/images/error.png" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                      </div>
                      <h5 style="text-align: center; margin-top: -50px"> {{ diasporaMessage  }} </h5>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <!-- Card item START -->
            <div class="col-sm-6 col-lg-3" v-else-if="empty === 0" v-for="result in diasporaData" :key="result.id">
                <div class="card bg-transparent">
                    <!-- Card img -->
                    <img class="card-img rounded" :src='getImage(result.og_file_url)' style="height: 150px; object-fit: cover" alt="{{ result.title }}">
                    <div class="card-body px-0 pt-3">
                        <h6 class="card-title mb-0"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset fw-bold" v-html="result.title"></span></h6>
                        <!-- Card info -->
                        <ul class="nav nav-divider align-items-center text-uppercase small mt-2">
                            <li class="nav-item">
                                <span @click="author(result.author_slug)" style="cursor: pointer" class="text-reset btn-link">{{ result.author_name }}</span>
                            </li>
                            <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Trending tags -->
            <div class="row px-3">
                <div class="col-12">
                    <ul class="list-inline mt-3">
                        <li class="list-inline-item">A voir aussi:</li>
                        <li class="list-inline-item"><span style="cursor: pointer" @click="fenetre" class="btn btn-sm btn-primary-soft">Fenêtres sur l'Afrique</span></li>
                    </ul>
                </div>
            </div> <!-- Row END -->
        </div>
    </div>
</template>
<script>
import {mapActions, mapGetters} from 'vuex';
import moment from 'moment'
export default {

    data(){
        return {
            loading: true,
            diasporaData: {},
            diasporaMessage: null,
            empty: 2
        }
    },

    computed:{
        ...mapGetters('diaspora',{
            getterInfosDiasporaStatus:'getInfosDiasporaStatus',
            getterInfosDiasporaMessage:'getInfosDiasporaMessage',
            getterInfosDiasporaData:'getInfosDiasporaData',
        }),
    },
    methods:{

        ...mapActions('diaspora',{
            actionDiasporaDataRequest:'diasporaDataRequest'
        }),


       async getResults(){

            this.loading = true

            await this.actionDiasporaDataRequest({});

            if( this.getterInfosDiasporaStatus ==="success"){

                this.diasporaData = this.getterInfosDiasporaData

                this.empty = 0

                this.loading = false

            }else if( this.getterInfosDiasporaStatus ==="empty"){

                this.diasporaMessage = this.getterInfosDiasporaMessage

                this.empty = 1

                this.loading = false

            }else{

                this.diasporaMessage = this.getterInfosDiasporaMessage

                this.empty = 3

                this.loading = false

            }
        },

        author(slug){
            window.location = '/authors/' + slug
        },

        article(slug){
            window.location = '/' + slug
        },

        getImage(slug){
            return 'https://togoactualite.com/wp-content/'+slug;
        },

        fenetre(){
            window.location = '/diaspora-diaspora-togo'
        },

    },

    mounted(){
        this.moment = moment
        this.getResults();
    }
}

</script>
