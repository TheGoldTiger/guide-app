import api from '/src/api'

export default {
  state: () => ({
    me: '',
    money: 0,
    
  }),
  getters: {
    getMe: state => state.me,
    getMoney: state => state.money,
  },
  actions: {
    async addUser({ dispatch }, name) {
      var response = await api.user.addUser(name);
      if (!response.data||response.data.length==0) {return false} else {
        localStorage.setItem('token', response.data.token);
        return response.data.name
      }
    },
    async getUserByName({commit, getters}, name) {
      var response = await api.user.getUserByName(name);
      if (!response.data||response.data.length==0) {return false} else {
        localStorage.setItem('token', response.data[0].token);
        return true
      }
    },
    async getUserByToken({commit, getters}, token) {
      var response = await api.user.getUserByToken(token);
      if (!response.data||response.data.length==0) {
        console.log('err in getUserByToken')
        return false
      } else {
        commit('SET_ME', response.data[0]);
        commit('SET_MONEY', response.data[0].money);
        return true
      }
    },
    async getAllUsers({}) {
      var response = await api.user.getAllUsers();
      return response.data;
    },
    async changeMoney({getters, commit}, castka){
      var money = parseInt(getters.getMoney)+parseInt(castka);
      var data = {player: getters.getMe.id, money: money};
      await api.user.changeUserMoney(data).then((result)=>{
        if (result) {
          commit('SET_MONEY', money);
        } else {
          console.log('err in changeMoney')
        }
      })
    },
    async setUserForLeaderboards({}, data){
      var response = await api.user.setUserForLeaderboards(data)
    },



    async getQuestionForUser({commit}, user) {
      var response = await api.question.getQuestionForUser(user);
      return response.data;
    },
    async sendAnswerForUser({dispatch}, data) {
      var response = await api.question.sendAnswerForUser(data);
      await dispatch("changeMoney", response.data.money_change);
      return response.data;
    },
    async getEventByCode({dispatch}, data) {
      var response = await api.event.getEventByCode(data);
      if (response.data){
        await dispatch('changeMoney', response.data.money_change);
      }
      return response.data;
    },



    async getAllWinners({}) {
      var response = await api.user.getAllWinners();
      return response.data;
    },
    async isWinnerDisplay({}, id) {
      var response = await api.user.isWinnerDisplay(id);
      return response.data;
    }
    
  },
  mutations: {
    SET_ME(state, data) {
      state.me = data
    },
    SET_MONEY(state, data) {
      state.money = data
    },
  },
}
