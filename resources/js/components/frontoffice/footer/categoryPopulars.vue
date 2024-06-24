<template>
    <!-- Hot topics START -->
        <div class="d-flex justify-content-center" v-if="loading">
            <div class="spinner-border text-light"  role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="row" v-else>
            <div class="col-6">
                <ul class="nav flex-column text-primary-hover">
                    <li class="nav-item text-white"><span class="nav-link pt-0" style="cursor: pointer; color: #fff" @click="category(info.slug)" v-for="info in categoryPopularsData.FirstSectionCategory" :key="info.id"> {{ info.name.toUpperCase() }} </span></li>
                </ul>
            </div>
                <div class="col-6">
                <ul class="nav flex-column text-primary-hover">
                    <li class="nav-item text-white"><span class="nav-link pt-0" style="cursor: pointer; color: #fff" @click="category(info.slug)" v-for="info in categoryPopularsData.TwoSectionCategory" :key="info.id"> {{ info.name.toUpperCase() }} </span></li>
                    <li class="nav-item text-white"><span class="nav-link pt-0" style="cursor: pointer; color: #fff" @click="category('events')">EVENEMENTS</span></li>
                    <li class="nav-item text-white"><span class="nav-link pt-0" style="cursor: pointer; color: #fff" @click="category('videos')">VIDEOS</span></li>
                </ul>
            </div>
        </div>

		<!-- Hot topics END -->
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import moment from 'moment'
export default {

    data(){
        return {
            loading: true,
            categoryPopularsData: {},
            categoryPopularsMessage: null,
            empty: 2
        }
    },

    computed:{
        ...mapGetters('categoryPopulars',{
            getterInfosCategoryPopularsStatus:'getInfosCategoryPopularsStatus',
            getterInfosCategoryPopularsMessage:'getInfosCategoryPopularsMessage',
            getterInfosCategoryPopularsData:'getInfosCategoryPopularsData',
        }),
    },
    methods:{

        ...mapActions('categoryPopulars',{
            actionCategoryPopularsDataRequest:'categoryPopularsDataRequest'
        }),


       async getResults(){

            this.loading = true

            await this.actionCategoryPopularsDataRequest({});

            if( this.getterInfosCategoryPopularsStatus ==="success"){

                this.categoryPopularsData = this.getterInfosCategoryPopularsData

                this.empty = 0

                this.loading = false

            }else if( this.getterInfosCategoryPopularsStatus ==="empty"){

                this.categoryPopularsMessage = this.getterInfosCategoryPopularsMessage

                this.empty = 1

                this.loading = false

            }else{

                this.categoryPopularsMessage = this.getterInfosCategoryPopularsMessage

                this.empty = 3

                this.loading = false

            }
        },

        category(slug){
            window.location = '/'+slug
        }
    },

    mounted(){
        this.moment = moment
        this.getResults();
    }
}
</script>
