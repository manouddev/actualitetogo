<template>
    <form class="input-group mt-2" @submit.prevent="store">
        <input v-if="errors.email" required type="email" name="email" v-model="data.email" class="form-control is-invalid" placeholder="Entrez votre email " />
        <input v-else required type="email" name="email" v-model="data.email" class="form-control " placeholder="Entrez votre email " />
        <button type="submit"  class="btn btn-primary m-0" v-if="!loading"><i class="bi bi-send"></i></button>
        <button type="button"  class="btn btn-primary m-0" v-else>
            <i  style="color: #fff" class="fa fa-spinner fa-1x fa-spin fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </button>
    </form>
    <div v-if="errors.email">
        <div v-for="errorName in errors.email" :key="errorName" class="form-text mt-2 text-white">
            {{ errorName }}
        </div>
    </div>
    <div v-else class="form-text mt-2 text-white">
        En vous abonnant, vous acceptez notre politique de confidentialité.
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
export default{
    data() {
        return {
            data: {
                email: null,
            },
            errors: {},
            loading: false,
        }
    },
    computed:{
        ...mapGetters('newsletter',{
            getterNewsletterStatus:'getNewsletterStatus',
            getterNewsletterMessage:'getNewsletterMessage',
            getterNewsletterErrors:'getNewsletterErrors',
        }),
    },
    methods:{

        ...mapActions('newsletter',{
            actionNewsletterRequest:'newsletterRequest'
        }),

       async store(){
            this.errors = []
            this.loading = true
            await this.actionNewsletterRequest({email: this.data.email})

            if (this.getterNewsletterStatus == "success") {

                this.errors = []

                this.loading = false

                const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', this.$swal.stopTimer)
                        toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: this.getterNewsletterMessage
                })

                this.data.email = null

            }else if (this.getterNewsletterStatus == "error") {

                this.loading = false

                this.errors = this.getterNewsletterErrors

            }else if (this.getterNewsletterStatus == "failed") {

                this.loading = false

                const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', this.$swal.stopTimer)
                        toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: this.getterNewsletterMessage
                })

            }
        },
    },

}
</script>
