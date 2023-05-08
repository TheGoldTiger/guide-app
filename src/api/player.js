export default (axios, path = 'http://localhost/api') => ({
    getAllUsers: async () => {
      var time = new Date().getTime();
      return await axios.get(`${path}/getAllPlayers?version=${time}`)
    },
    getUserByName: async (name) => {
      var time = new Date().getTime();
      return await axios.get(`${path}/getPlayerByName?name=${name}&version=${time}`)
    },
    getUserByToken: async (token) => {
      var time = new Date().getTime();
      return await axios.get(`${path}/getPlayerByToken?token=${token}&version=${time}`)
    },
    getAllWinners: async () => {
      var time = new Date().getTime();
      return await axios.get(`${path}/getAllWinners?version=${time}`)
    },
    changeUserMoney: async (data) => {
      return await axios.post(`${path}/changePlayerMoney`, data)
    },
    addUser: async (name) => {
      return await axios.post(`${path}/addPlayer`, name)
    },
    removeUser: async (id) => {
      return await axios.post(`${path}/removePlayer`, id)
    },
    setUserForLeaderboards: async (id) => {
      return await axios.post(`${path}/setPlayerForVisibleInLeaderboards `, id)
    },
    isWinnerDisplay: async (id) => {
      var time = new Date().getTime();
      return await axios.get(`${path}/isWinnerDisplay?player=${id}&version=${time}`)
    }
  })
  