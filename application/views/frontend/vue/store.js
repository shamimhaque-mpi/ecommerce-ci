import Vue  from "./module/vue.js";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        url  	  : '',
        isLogin   : false,
        cart 	  : []
    },
    getters: {

    },
    mutations: {

    }
});

export default store;
