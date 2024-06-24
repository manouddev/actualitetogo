<template>
    <div class="d-flex justify-content-center" v-if="loading">
        <div class="spinner-border text-light"  role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div v-else class="mb-4 position-relative" v-for="info in publicationsPopularsData" :key="info.id">
        <div><span @click="category(info.category_slug)" style="cursor: pointer"  class="badge text-bg-danger mb-2"><i class="fas fa-circle me-2 small fw-bold"></i> {{ info.category_name }} </span></div>
        <span @click="article(info.slug)" style="cursor: pointer" class="btn-link text-white fw-normal" v-html="info.title"></span>
        <ul class="nav nav-divider align-items-center small mt-2 text-muted">
            <li class="nav-item position-relative">
                <div class="nav-link">par <span @click="author(info.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link"> {{ info.author_name }} </span>
                </div>
            </li>
            <li class="nav-item">{{ moment(info.date_publish).format("DD/MM/YYYY") }}</li>
        </ul>
    </div>
    <!-- Item -->

</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import moment from 'moment'
export default {

    data(){
        return {
            loading: true,
            publicationsPopularsData: {},
            articlesPopularsMessage: null,
            empty: 2
        }
    },

    computed:{
        ...mapGetters('articlesPopulars',{
            getterInfosArticlesPopularsStatus:'getInfosArticlesPopularsStatus',
            getterInfosArticlesPopularsMessage:'getInfosArticlesPopularsMessage',
            getterInfosArticlesPopularsData:'getInfosArticlesPopularsData',
        }),
    },
    methods:{

        ...mapActions('articlesPopulars',{
            actionArticlesPopularsDataRequest:'articlesPopularsDataRequest'
        }),


       async getResults(){

            this.loading = true

            await this.actionArticlesPopularsDataRequest({});

            if( this.getterInfosArticlesPopularsStatus ==="success"){

                this.publicationsPopularsData = this.getterInfosArticlesPopularsData

                this.empty = 0

                this.loading = false

            }else if( this.getterInfosArticlesPopularsStatus ==="empty"){

                this.articlesPopularsMessage = this.getterInfosArticlesPopularsMessage

                this.empty = 1

                this.loading = false

            }else{

                this.articlesPopularsMessage = this.getterInfosArticlesPopularsMessage

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

        category(slug){
            window.location = '/' + slug
        },

    },

    mounted(){
        this.moment = moment
        this.getResults();
    }
}
</script>
