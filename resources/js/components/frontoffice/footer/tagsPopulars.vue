<template>
    <!-- Hot topics START -->
    <div class="d-flex justify-content-center" v-if="loading">
        <div class="spinner-border text-light"  role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="row" v-else>
        <h5 class="mb-2 text-white">Les mots clés populaires</h5>
        <ul class="list-inline text-primary-hover lh-lg">
            <li class="list-inline-item" v-for="info in tagsPopularsData" :key="info.id"><span @click="tag(info.slug)" style="cursor: pointer">#{{ info.name }} </span></li>
        </ul>
    </div>
    <!-- Hot topics END -->
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
export default {

    data(){
        return {
            loading: true,
            tagsPopularsData: {},
            tagsPopularsMessage: null,
            empty: 2
        }
    },

    computed:{
        ...mapGetters('tagsPopulars',{
            getterInfosTagsPopularsStatus:'getInfosTagsPopularsStatus',
            getterInfosTagsPopularsMessage:'getInfosTagsPopularsMessage',
            getterInfosTagsPopularsData:'getInfosTagsPopularsData',
        }),
    },
    methods:{

        ...mapActions('tagsPopulars',{
            actionTagsPopularsDataRequest:'tagsPopularsDataRequest'
        }),


       async getResults(){

            this.loading = true

            await this.actionTagsPopularsDataRequest({});

            if( this.getterInfosTagsPopularsStatus ==="success"){

                this.tagsPopularsData = this.getterInfosTagsPopularsData

                this.empty = 0

                this.loading = false

            }else if( this.getterInfosTagsPopularsStatus ==="empty"){

                this.tagsPopularsMessage = this.getterInfosTagsPopularsMessage

                this.empty = 1

                this.loading = false

            }else{

                this.tagsPopularsMessage = this.getterInfosTagsPopularsMessage

                this.empty = 3

                this.loading = false

            }
        },

        tag(slug){
            window.location = '/tags/'+slug
        }
    },

    mounted(){
        this.getResults();
    }
}
</script>
