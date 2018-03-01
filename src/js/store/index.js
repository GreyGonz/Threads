import Vue from 'vue'
import Vuex from 'vuex'
import * as getters from './getters.js'

Vue.use(Vuex);

const store = new Vuex.Store({
  strict: true,
  state: {
    threads: [],
    count: 1
  },
  getters
  //
  // getters: {
  //   count: function (state) {
  //     return state.count
  //   }
  // },
  // mutations: {
  //   count: function (state, value) {
  //     state.count = value;
  //   }
  // }
});

export default store