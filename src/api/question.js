export default (axios, path = 'http://localhost/api') => ({
    sendAnswerForUser: async (data) => {
      var time = new Date().getTime();
      return await axios.post(`${path}/sendAnswerForPlayer?version=${time}`, data)
    },
    getQuestionForUser: async (id) => {
      var time = new Date().getTime();
      return await axios.get(`${path}/getQuestionForPlayer?player=${id}&version=${time}`)
    },
  })
  