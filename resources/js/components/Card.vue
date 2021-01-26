<template>
    <card class="flex flex-col items-center justify-center">
        <div class="px-3 py-3">

            <h1 class="text-center text-80 pt-0 pb-6"> Currency Conversion</h1>


            <div class="mb-6 text-center">
                <a href="javascript:void(0)" @click="selectTab('inrTOusd','USD')" :class="{'font-bold' : tab === 'inrTOusd'}"> INR vs USD</a> | 
                <a href="javascript:void(0)" @click="selectTab('inrTOgbp','GBP')" :class="{'font-bold' : tab === 'inrTOgbp'}"> INR vs GBP</a> | 
                <a href="javascript:void(0)" @click="selectTab('inrTOeur','EUR')" :class="{'font-bold' : tab === 'inrTOeur'}"> INR vs EUR</a>
            </div>

            <div v-show="tab === 'inrTOusd'" class="pt-5 text-center">
                <h4 class="text-center text-3xl text-80 font-light">1 {{base}} = {{conversion.rate}} {{to}}</h4>
            </div>

            <div v-show="tab === 'inrTOgbp'" class="pt-5 text-center">
                <h4 class="text-center text-3xl text-80 font-light">1 {{base}} =  {{conversion.rate}} {{to}}</h4>
            </div>

            <div v-show="tab === 'inrTOeur'" class="pt-5 text-center">
                <h4 class="text-center text-3xl text-80 font-light">1 {{base}} =  {{conversion.rate}} {{to}}</h4>
            </div>
        </div>
    </card>
</template>

<script>
export default {
    props: [
        'card',
    ],

    data: () => {
        return {
            conversion: {},
            tab: 'inrTOusd',
            base: 'INR',
            to:'USD'
        };
    },

    methods: {
        selectTab: function(tab,to) {
            this.tab = tab;
            this.to = to;
            Nova.request().get('/nova-vendor/testcard/currency-convert/'+this.base+'/'+this.to).then(response => {
                this.conversion = response.data;
                this.$toasted.show(this.base+' converted to '+this.to,{type:'success','duration':500});
            });
        }
    },

    mounted() {
        Nova.request().get('/nova-vendor/testcard/currency-convert/'+this.base+'/'+this.to).then(response => {
            this.conversion = response.data;
            this.$toasted.show(this.base+' converted to '+this.to,{type:'success','duration':500});
        });
    },
}
</script>
